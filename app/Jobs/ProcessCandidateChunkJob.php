<?php

namespace App\Jobs;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Candidate;
use App\Models\CandidateState;
use App\Models\Civ;
use App\Models\Position;
use App\Models\Compagny;
use App\Models\Disponibility;
use App\Models\Speciality;
use App\Models\Field;
use App\Repositories\CandidateRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ImportLog;

class ProcessCandidateChunkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chunk;
    protected $headers;
    protected $userId;
    public $filePath;

    public function __construct($chunk, $headers, $userId, $filePath)
    {
        $this->chunk = $chunk;
        $this->headers = $headers;
        $this->userId = $userId;
        $this->filePath = $filePath;
    }

    public function handle()
    {
        $fileData = [];
        foreach ($this->chunk as $usager) {
            if (array_filter($usager)) {
                $cell = [];
                foreach ($this->headers as $index => $header) {
                    $cell[$header] = $usager[$index] ?? null;
                }
                array_push($fileData, $cell);
            }
        }

        $existingCandidates = Candidate::select('first_name', 'last_name', 'email', 'phone')->get();
        $accepted = [];
        $rejected = [];

        foreach ($fileData as $row) {
            $exists = $existingCandidates->firstWhere('first_name', $row['Prénom'])
                && $existingCandidates->firstWhere('last_name', $row['Nom'])
                && $existingCandidates->firstWhere('email', $row['Mail'])
                && $existingCandidates->firstWhere('phone', $row['Tél1']);

            if ($exists) {
                $rejected[] = $row;
                continue;
            }

            $newCandidate = [
                'created_by' => $this->userId,
                'origine' => $row['Source'] ?? '',
                'first_name' => $row['Prénom'] ?? '',
                'last_name' => $row['Nom'] ?? '',
                'code_cdt' => Str::limit(preg_replace('/[^a-zA-Z0-9]/', '', Hash::make($row['Prénom'] . $row['Nom'] . now())), 7, ''),
                'email' => $row['Mail'] ?? '',
                'phone' => $row['Tél1'] ?? '',
                'phone_2' => $row['Tél2'] ?? '',
                'url_ctc' => $row['UrlCTC'] ?? '',
                'postal_code' => $row['CP/Dpt'] ?? '',
                'city' => $row['Ville'] ?? '',
                'region' => $row['Région'] ?? '',
                'country' => $row['Pays'] ?? '',
                'cdt_status' => $row['Statut CDT'] ?? '',
                'candidate_state_id' => CandidateState::firstWhere('name', 'Attente')->id,
            ];

            $relations = [
                'civ_id' => ['model' => Civ::class, 'field' => 'Civ'],
                'position_id' => ['model' => Position::class, 'field' => 'Poste'],
                'compagny_id' => ['model' => Compagny::class, 'field' => 'Société'],
                'disponibility_id' => ['model' => Disponibility::class, 'field' => 'Disponibilité'],
            ];

            foreach ($relations as $key => $relation) {
                if (!empty($row[$relation['field']])) {
                    $newCandidate[$key] = $relation['model']::firstOrCreate(['name' => $row[$relation['field']]])->id;
                }
            }

            $candidateRepository = new CandidateRepository();
            $candidate = $candidateRepository->create($newCandidate);

            if ($candidate) {
                $attachments = [
                    'specialities' => ['model' => Speciality::class, 'field' => 'Spécialité'],
                    'fields' => ['model' => Field::class, 'field' => 'Domaine'],
                ];

                foreach ($attachments as $relation => $attachment) {
                    if (!empty($row[$attachment['field']])) {
                        $modelInstance = $attachment['model']::firstOrCreate(['name' => $row[$attachment['field']]]);
                        $candidate->{$relation}()->attach($modelInstance->id);
                    }
                }
                $accepted[$candidate->id] = $candidate;
            } else {
                $rejected[] = $row;
            }
        }

        ImportLog::create([
            'accepted' => json_encode($accepted),
            'rejected' => json_encode($rejected),
            'user_id' => $this->userId,
            'file_path' => $this->filePath,
        ]);
    }
}
