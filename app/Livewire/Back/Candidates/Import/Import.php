<?php

namespace App\Livewire\Back\Candidates\Import;

use App\Models\Civ;
use Livewire\Component;
use App\Models\Candidate;
use App\Models\Compagny;
use App\Models\Disponibility;
use App\Models\Field;
use App\Models\Position;
use App\Models\Speciality;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
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
        try {
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
                    $cell[$headers[0]] = $usager[0];
                    $cell[$headers[1]] = $usager[1];
                    $cell[$headers[2]] = $usager[2];
                    $cell[$headers[3]] = $usager[3];
                    $cell[$headers[4]] = $usager[4];
                    $cell[$headers[5]] = $usager[5];
                    $cell[$headers[6]] = $usager[6];
                    $cell[$headers[7]] = $usager[7];
                    $cell[$headers[8]] = $usager[8];
                    $cell[$headers[9]] = $usager[9];
                    $cell[$headers[10]] = $usager[10];
                    $cell[$headers[11]] = $usager[11];
                    $cell[$headers[12]] = $usager[12];
                    $cell[$headers[13]] = $usager[13];
                    $cell[$headers[14]] = $usager[14];
                    $cell[$headers[15]] = $usager[15];
                    $cell[$headers[16]] = $usager[16];
                    $cell[$headers[17]] = $usager[17];
                    array_push($fileData, $cell);
                }
            }
        } catch (\Throwable $th) {
            return $this->dispatch('alert', type: 'error', message: 'Une erreure est survenu lors de l\'analyse de votre fichier, merci de réessayez');
        }
        DB::beginTransaction();
        foreach ($fileData as $key => $value) {
            $checkExistingCandidate = $this->checkExistingCandidate($value);
            if ($checkExistingCandidate == false) {
                $newCandidate = $this->addCandidate($value);
                if($newCandidate){
                    $this->accepted[$newCandidate->id] = $newCandidate;
                }else {
                    $this->rejected[$key] = $value;
                }
            }else {
                $this->rejected[$key] = $value;
            }
        }
        DB::commit();
        $this->dispatch('data-from-import', accepted: $this->accepted, rejected: $this->rejected);
        $this->dispatch('alert', type: 'success', message: 'Opération reusie avec succès');
        $this->reset(['file']);

    }
    public function addCandidate($data)
    {
        try {
            $candidateRepository = new CandidateRepository();
            $newCandidate = [];
            $newCandidate['created_by'] = auth()->user()->id;
            $newCandidate['certificate'] = Str::random(10);
            $newCandidate['origine'] = $data['Source'] ?? '';
            $newCandidate['first_name'] = $data['Prénom'] ?? '';
            $newCandidate['last_name'] = $data['Nom'] ?? '';
            $newCandidate['code_cdt'] = $newCandidate['first_name'] . $newCandidate['last_name'];
            $newCandidate['email'] = $data['Mail'] ?? '';
            $newCandidate['phone'] = $data['Tél1'] ?? '';
            $newCandidate['phone_2'] = $data['Tél2'] ?? '';
            $newCandidate['url_ctc'] = $data['UrlCTC'] ?? '';
            $newCandidate['postal_code'] = $data['CP/Dpt'] ?? '';
            $newCandidate['city'] = $data['Ville'] ?? '';
            $newCandidate['region'] = $data['Région'] ?? '';
            $newCandidate['country'] = $data['Pays'] ?? '';
            $newCandidate['cdt_status'] = $data['Statut CDT'] ?? '';
            $civ = Civ::where('name', $data['Civ'])->first() ?? Civ::create(['name' => $data['Civ']]);
            if ($civ) {
                $newCandidate['civ_id'] = $civ->id;
            }
            if (!empty($data['Poste'])) {
                $position = Position::where('name', $data['Poste'])->first() ?? Position::create(['name' => $data['Poste']]);
                if ($position) {
                    $newCandidate['position_id'] = $position->id;
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
            if (!empty($data['Spécialité'] && $candidate)) {
                $speciality = Speciality::where('name', $data['Poste'])->first() ?? Speciality::create(['name' => $data['Poste']]);
                $candidate->specialities()->attach($speciality->id);
            }
            if (!empty($data['Domaine'] && $candidate)) {
                $field = Field::where('name', $data['Domaine'])->first() ?? Field::create(['name' => $data['Domaine']]);
                $candidate->fields()->attach($field->id);
            }

            return $candidate;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function checkExistingCandidate($data)
    {
        try {
            $firsName = $data['Prénom'] ?? '';
            $lastName = $data['Nom'] ?? '';
            $phone = $data['Tél1'] ?? '';
            $email = $data['Mail'] ?? '';
            $existingCandidate = Candidate::when($firsName, function ($query) use ($firsName) {
                $query->where('first_name', $firsName);
            })
                ->when($email, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->when($phone, function ($query) use ($phone) {
                    $query->where('phone', $phone);
                })
                ->where('last_name', $lastName)
                ->exists();
            if ($existingCandidate) {
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            return true;
        }
    }
    public function checkDoublon()
    {
    }
    public function render()
    {
        return view('livewire.back.candidates.import.import');
    }
}
