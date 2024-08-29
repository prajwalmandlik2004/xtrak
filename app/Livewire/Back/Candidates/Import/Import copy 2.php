<?php

namespace App\Livewire\Back\Candidates\Import;

use App\Models\Civ;
use App\Models\Field;
use Livewire\Component;
use App\Models\Compagny;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Speciality;
use Illuminate\Support\Str;
use App\Models\Disponibility;
use Livewire\WithFileUploads;
use App\Models\CandidateState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Repositories\CandidateRepository;

class Import extends Component
{
    use WithFileUploads;
    public $file;
    public $fileData;
    public $rejected = [];
    public $accepted = [];
    public function storeData()
    {
        $validateData = $this->validate(
            [
                'file' => 'mimes:xlsx,xls,xlsm',
            ],
            [
                'file.mimes' => 'Le fichier doit être un tableur comme excel',
            ],
        );
        // try {
        $path = Storage::putFile('/public/files', $validateData['file']);
        $filepath = Storage::path($path);
        if (file_exists($filepath)) {
            $spreadsheet = IOFactory::load($filepath);
            $worksheet = $spreadsheet->getActiveSheet();
            $headers = $worksheet->toArray()[0];
            $worksheet->removeRow(1);
            $usagers = $worksheet->toArray();
            $fileData = [];
            foreach ($usagers as $usager) {
                // Skip empty rows
                if (array_filter($usager)) {
                    $cell = [];
                    foreach ($headers as $index => $header) {
                        if (isset($usager[$index])) {
                            $cell[$header] = $usager[$index];
                        } else {
                            $cell[$header] = null;
                        }
                    }
                    array_push($fileData, $cell);
                }
            }
        } else {
            return $this->dispatch('alert', type: 'error', message: 'Le fichier est vide');
        }
        DB::beginTransaction();
        foreach ($fileData as $key => $value) {
            if (!$this->checkExistingCandidate($value)) {
                $newCandidate = $this->addCandidate($value);
                if ($newCandidate) {
                    $this->accepted[$newCandidate->id] = $newCandidate;
                } else {
                    $this->rejected[$key] = $value;
                }
            } else {
                $this->rejected[$key] = $value;
            }
        }

        DB::commit();
        $this->dispatch('data-from-import', accepted: $this->accepted, rejected: $this->rejected);
        $this->dispatch('alert', type: 'success', message: 'Opération reusie avec succès');
        $this->reset(['file']);
        // } catch (\Throwable $th) {
        //     return $this->dispatch('alert', type: 'error', message: 'Une erreure est survenu, merci de réessayez');
        // }
    }
    public function addCandidate($data)
    {
        $candidateRepository = new CandidateRepository();
        $newCandidate = [
            'created_by' => Auth::id(),
            'origine' => $data['Source'] ?? '',
            'first_name' => $data['Prénom'] ?? '',
            'last_name' => $data['Nom'] ?? '',
            'code_cdt' => Str::limit(preg_replace('/[^a-zA-Z0-9]/', '', Hash::make($data['Prénom'] . $data['Nom'] . now())), 7, ''),
            'email' => $data['Mail'] ?? '',
            'phone' => $data['Tél1'] ?? '',
            'phone_2' => $data['Tél2'] ?? '',
            'url_ctc' => $data['UrlCTC'] ?? '',
            'postal_code' => $data['CP/Dpt'] ?? '',
            'city' => $data['Ville'] ?? '',
            'region' => $data['Région'] ?? '',
            'country' => $data['Pays'] ?? '',
            'cdt_status' => $data['Statut CDT'] ?? '',
            'candidate_state_id' => CandidateState::firstWhere('name', 'Attente')->id,
        ];
        $relations = [
            'civ_id' => ['model' => Civ::class, 'field' => 'Civ'],
            'position_id' => ['model' => Position::class, 'field' => 'Poste'],
            'compagny_id' => ['model' => Compagny::class, 'field' => 'Société'],
            'disponibility_id' => ['model' => Disponibility::class, 'field' => 'Disponibilité'],
        ];
        foreach ($relations as $key => $relation) {
            if (!empty($data[$relation['field']])) {
                $newCandidate[$key] = $relation['model']::firstOrCreate(['name' => $data[$relation['field']]])->id;
            }
        }
        $candidate = $candidateRepository->create($newCandidate);
        $attachments = [
            'specialities' => ['model' => Speciality::class, 'field' => 'Spécialité'],
            'fields' => ['model' => Field::class, 'field' => 'Domaine'],
        ];
        foreach ($attachments as $relation => $attachment) {
            if (!empty($data[$attachment['field']]) && $candidate) {
                $modelInstance = $attachment['model']::firstOrCreate(['name' => $data[$attachment['field']]]);
                $candidate->{$relation}()->attach($modelInstance->id);
            }
        }
        return $candidate;
    }
    public function checkExistingCandidate($data)
    {
        return Candidate::when(!empty($data['Prénom']), fn($query) => $query->where('first_name', $data['Prénom']))
            ->when(!empty($data['Nom']), fn($query) => $query->where('last_name', $data['Nom']))
            ->when(!empty($data['Mail']), fn($query) => $query->where('email', $data['Mail']))
            ->when(!empty($data['Tél1']), fn($query) => $query->where('phone', $data['Tél1']))
            ->exists();
    }

    public function render()
    {
        return view('livewire.back.candidates.import.import');
    }
}
