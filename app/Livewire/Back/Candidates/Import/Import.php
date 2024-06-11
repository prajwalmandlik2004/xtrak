<?php

namespace App\Livewire\Back\Candidates\Import;

use Carbon\Carbon;
use App\Models\Civ;
use App\Models\Field;
use Livewire\Component;
use App\Models\Compagny;
use App\Models\NextStep;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Speciality;
use Illuminate\Support\Str;
use App\Models\Disponibility;
use Livewire\WithFileUploads;
use App\Models\CandidateState;
use App\Models\CandidateStatut;
use App\Models\NsDate;
use Illuminate\Support\Facades\DB;
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
        // Configuration des paramètres PHP pour augmenter le temps d'exécution et la mémoire
        ini_set('max_execution_time', 7200); 
        ini_set('memory_limit', '512M'); 

        // Configuration des paramètres de session MySQL
        DB::statement('SET SESSION wait_timeout = 28800;');
        DB::statement('SET SESSION interactive_timeout = 28800;');

        try {
            $path = Storage::putFile('/public/files', $this->file);
            $filepath = Storage::path($path);
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
        } catch (\Throwable $th) {
            return $this->dispatch('alert', type: 'error', message: 'Une erreur est survenue lors de l\'analyse de votre fichier, merci de réessayer.');
        }

        // Traitaiment des données par lots pour éviter les timeouts
        $batchSize = 100; 
        $totalBatches = ceil(count($fileData) / $batchSize);

        for ($batch = 0; $batch < $totalBatches; $batch++) {
            $start = $batch * $batchSize;
            $currentBatch = array_slice($fileData, $start, $batchSize);

            DB::beginTransaction();
            try {
                foreach ($currentBatch as $key => $value) {
                    $checkExistingCandidate = $this->checkExistingCandidate($value);
                    if ($checkExistingCandidate == false) {
                        $newCandidate = $this->addCandidate($value, 'Attente');
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
            } catch (\Throwable $th) {
                DB::rollback();
                return $this->dispatch('alert', type: 'error', message: 'Une erreur est survenue lors de l\'importation des données.');
            }
        }

        $this->dispatch('data-from-import', accepted: $this->accepted, rejected: $this->rejected);
        $this->dispatch('alert', type: 'success', message: 'Opération réussie avec succès.');
        $this->reset(['file']);
    }

    public function addCandidate($data, $stateName)
    {
        try {
            $candidateRepository = new CandidateRepository();
            $newCandidate = [];
            $newCandidate['created_by'] = auth()->user()->id;
            $newCandidate['origine'] = $data['Source'] ?? '';
            $newCandidate['first_name'] = $data['Prénom'] ?? '';
            $newCandidate['last_name'] = $data['Nom'] ?? '';
            $stringToHash = $newCandidate['first_name'] . $newCandidate['last_name'] . now();
            $hash = Hash::make($stringToHash);
            $newCandidate['code_cdt'] = Str::limit(preg_replace('/[^a-zA-Z0-9]/', '', $hash), 7, '');
            $newCandidate['email'] = $data['Mail'] ?? '';
            $newCandidate['phone'] = $data['Tél1'] ?? '';
            $newCandidate['phone_2'] = $data['Tél2'] ?? '';
            $newCandidate['url_ctc'] = $data['UrlCTC'] ?? '';
            $newCandidate['postal_code'] = $data['CP/Dpt'] ?? '';
            $newCandidate['city'] = $data['Ville'] ?? '';
            $newCandidate['region'] = $data['Région'] ?? '';
            $newCandidate['country'] = $data['Pays'] ?? '';
            $newCandidate['candidate_state_id'] = CandidateState::where('name', $stateName)->first()->id ?? null;

            if (!empty($data['Statut CDT'])) {
                $cdtStatus = CandidateStatut::where('name', $data['Statut CDT'])->first() ?? CandidateStatut::create(['name' => $data['Statut CDT']]);
                if ($cdtStatus) {
                    $newCandidate['cdt_status'] = $cdtStatus->id;
                }
            }
            if (!empty($data['NSDate'])) {
                $nsDate = NsDate::where('name', $data['NSDate'])->first() ?? NsDate::create(['name' => $data['NSDate']]);
                if ($nsDate) {
                    $newCandidate['ns_date_id'] = $nsDate->id;
                }
            }
            if (!empty($data['NextStep'])) {
                $nextStep = NextStep::where('name', $data['NextStep'])->first() ?? NextStep::create(['name' => $data['NextStep']]);
                if ($nextStep) {
                    $newCandidate['next_step_id'] = $nextStep->id;
                }
            }
            if (!empty($data['Civ'])) {
                $civ = Civ::where('name', $data['Civ'])->first() ?? Civ::create(['name' => $data['Civ']]);
                if ($civ) {
                    $newCandidate['civ_id'] = $civ->id;
                }
            }
            if (!empty($data['Poste'])) {
                $position = Position::where('name', $data['Poste'])->first() ?? Position::create(['name' => $data['Poste']]);
                if ($position) {
                    $newCandidate['position_id'] = $position->id;
                }
            }
            if (!empty($data['Spécialité'])) {
                $speciality = Speciality::where('name', $data['Spécialité'])->first() ?? Speciality::create(['name' => $data['Spécialité'], 'position_id' => $newCandidate['position_id'] ?? null]);
                if ($speciality) {
                    $newCandidate['speciality_id'] = $speciality->id;
                }
            }
            if (!empty($data['Domaine'])) {
                $field = Field::where('name', $data['Domaine'])->first() ?? Field::create(['name' => $data['Domaine'], 'speciality_id' => $newCandidate['speciality_id'] ?? null]);
                if ($field) {
                    $newCandidate['field_id'] = $field->id;
                }
            }

            if (!empty($data['Société'])) {
                $compagny = Compagny::where('name', $data['Société'])->first() ?? Compagny::create(['name' => $data['Société']]);
                if ($compagny) {
                    $newCandidate['compagny_id'] = $compagny->id;
                }
            }
            if (!empty($data['Disponibilité'])) {
                $disponibility = Disponibility::where('name', $data['Disponibilité'])->first() ?? Disponibility::create(['name' => $data['Disponibilité']]);
                if ($disponibility) {
                    $newCandidate['disponibility_id'] = $disponibility->id;
                }
            }

            $candidate = $candidateRepository->create($newCandidate);

            return $candidate;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function checkExistingCandidate($data)
    {
        try {
            $firstName = $data['Prénom'] ?? '';
            $lastName = $data['Nom'] ?? '';
            $phone = $data['Tél1'] ?? '';
            $email = $data['Mail'] ?? '';
            $existingCandidate = Candidate::when($firstName, function ($query) use ($firstName) {
                return $query->where('first_name', $firstName);
            })->when($lastName, function ($query) use ($lastName) {
                return $query->where('last_name', $lastName);
            })->when($phone, function ($query) use ($phone) {
                return $query->orWhere('phone', $phone);
            })->when($email, function ($query) use ($email) {
                return $query->orWhere('email', $email);
            })->exists();
            return $existingCandidate;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function render()
    {
        return view('livewire.back.candidates.import.import');
    }
}
