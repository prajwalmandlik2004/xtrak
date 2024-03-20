<?php

namespace App\Livewire\Back\Candidates;

use App\Models\Civ;
use App\Models\File;
use App\Models\Field;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Compagny;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Disponibility;
use App\Models\NextStep;
use App\Models\Speciality;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;
use App\Repositories\CandidateRepository;

class Form extends Component
{
    use WithFileUploads;
    public $civs;
    public $civ_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $phone_2;
    public $compagny_id;
    public $postal_code;
    public $cdt_status;
    public $position_id;
    public $positions;
    public $candidate;
    public $created_by;
    public $autorizeAddCandidate = true;
    public $action;
    public $files = [];
    public $city;
    public $address;
    public $region;
    public $country;
    public $disponibilities;
    public $disponibility_id;
    public $url_ctc;
    public $specialities;
    public $specialitiesSelected;
    public $fields;
    public $fieldsSelected;
    public $compagnies;
    public $commentaire;
    public $origine;
    public $nextSteps;
    public $next_step_id;
    public $ns_date;

    public function mount()
    {
        $this->nextSteps = NextStep::all();
        $this->civs = Civ::all();
        $this->disponibilities = Disponibility::all();
        $this->positions = Position::orderBy('name', 'asc')->get();
        $this->specialities = Speciality::orderBy('name', 'asc')->get();
        $this->fields = Field::orderBy('name', 'asc')->get();
        $this->compagnies = Compagny::orderBy('name', 'asc')->get();
        if ($this->candidate && $this->candidate->exists) {
            $this->civ_id = $this->candidate->civ_id;
            $this->first_name = $this->candidate->first_name;
            $this->last_name = $this->candidate->last_name;
            $this->email = $this->candidate->email;
            $this->phone = $this->candidate->phone;
            $this->compagny_id = $this->candidate->compagny->id;
            $this->postal_code = $this->candidate->postal_code;
            $this->cdt_status = $this->candidate->cdt_status;
            $this->position_id = $this->candidate->position_id;
            $this->city = $this->candidate->city;
            $this->address = $this->candidate->address;
            $this->region = $this->candidate->region;
            $this->country = $this->candidate->country;
            $this->disponibility_id = $this->candidate->disponibility_id;
            $this->next_step_id = $this->candidate->next_step_id;
            $this->url_ctc = $this->candidate->url_ctc;
            $this->specialitiesSelected = $this->candidate->specialities->pluck('id')->toArray() ?? [];
            $this->fieldsSelected = $this->candidate->fields->pluck('id')->toArray() ?? [];
            $this->commentaire = $this->candidate->commentaire;
            $this->origine = $this->candidate->origine;
            $this->ns_date = $this->candidate->ns_date;
        }
    }

    public function updated($field)
    {
        $this->checkExistingCandidate();
    }
    public function checkExistingCandidate()
    {
        if (!empty($this->last_name)) {
            $existingCandidate = Candidate::when($this->first_name, function ($query) {
                $query->where('first_name', $this->first_name);
            })
                ->when($this->email, function ($query) {
                    $query->where('email', $this->email);
                })
                ->when($this->phone, function ($query) {
                    $query->where('phone', $this->phone);
                })
                ->when($this->compagny_id, function ($query) {
                    $query->where('compagny_id', $this->compagny_id);
                })
                ->when($this->postal_code, function ($query) {
                    $query->where('postal_code', $this->postal_code);
                })

                ->when($this->civ_id, function ($query) {
                    $query->where('civ_id', $this->civ_id);
                })
                ->when($this->city, function ($query) {
                    $query->where('city', $this->city);
                })
                ->when($this->region, function ($query) {
                    $query->where('region', $this->region);
                })
                ->when($this->country, function ($query) {
                    $query->where('country', $this->country);
                })
                ->where('last_name', $this->last_name)
                ->exists();

            if ($existingCandidate) {
                $this->autorizeAddCandidate = false;
                if (!empty($this->first_name)) {
                    $this->addError('first_name', 'Ce candidat existe déjà.');
                }
                if (!empty($this->last_name)) {
                    $this->addError('last_name', 'Ce candidat existe déjà.');
                }
                if (!empty($this->phone)) {
                    $this->addError('phone', 'Ce candidat existe déjà.');
                }
                if (!empty($this->compagny_id)) {
                    $this->addError('compagny_id', 'Ce candidat existe déjà.');
                }
                if (!empty($this->postal_code)) {
                    $this->addError('postal_code', 'Ce candidat existe déjà.');
                }
                if (!empty($this->email)) {
                    $this->addError('email', 'Ce candidat existe déjà.');
                }

                if (!empty($this->civ_id)) {
                    $this->addError('civ_id', 'Ce candidat existe déjà.');
                }
                if (!empty($this->city)) {
                    $this->addError('city', 'Ce candidat existe déjà.');
                }

                if (!empty($this->region)) {
                    $this->addError('region', 'Ce candidat existe déjà.');
                }
                if (!empty($this->country)) {
                    $this->addError('country', 'Ce candidat existe déjà.');
                }
            } else {
                $this->autorizeAddCandidate = true;
                $this->resetErrorBag(['first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'position_id', 'civ_id', 'city', 'region', 'country']);
            }
        }
    }

    public function storeData()
    {
        $validatedData = $this->validate(
            [
                'civ_id' => 'nullable',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => $this->action == 'create' ? 'nullable|email|unique:candidates,email' : 'nullable|email',
                'phone' => 'nullable',
                'compagny_id' => 'nullable',
                'postal_code' => 'nullable',
                'cdt_status' => 'nullable',
                'position_id' => 'nullable',
                'files' => 'nullable',
                'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
                'city' => 'nullable',
                'address' => 'nullable',
                'region' => 'nullable',
                'country' => 'nullable',
                'disponibility_id' => 'nullable',
                'url_ctc' => 'nullable',
                'specialitiesSelected' => 'nullable',
                'fieldsSelected' => 'nullable',
                'phone_2' => 'nullable',
                'commentaire' => 'nullable',
                'origine' => 'nullable',
                'ns_date' => 'nullable',
                'next_step_id' => 'nullable',
            ],
            [
                // 'civ_id.required' => 'Le titre est obligatoire',
                'first_name.required' => 'Le prénom est obligatoire',
                'last_name.required' => 'Le nom est obligatoire',
                // 'email.required' => 'L\'email est obligatoire',
                // 'email.email' => 'L\'email doit être une adresse email valide',
                // 'phone.required' => 'Le téléphone est obligatoire',
                // 'compagny_id.required' => 'La société est obligatoire',
                // 'postal_code.required' => 'Le code postal est obligatoire',
                // 'cdt_status.required' => 'Le statut est obligatoire',
                // 'position_id.required' => 'Le poste est obligatoire',
                // 'email.unique' => 'Cet email existe déjà. Veuillez en saisir un autre.',
            ],
        );
        try {
            DB::beginTransaction();
            $candidateRepository = new CandidateRepository();
            $fileRepository = new FileRepository();
            if ($this->action == 'create') {
                $validatedData['created_by'] = auth()->user()->id;
                if (!empty($validatedData['files'])) {
                    $validatedData['certificate'] = Str::random(10);
                }
                $validatedData['code_cdt'] = $validatedData['first_name'] . $validatedData['last_name'];
                $candidate = $candidateRepository->create($validatedData);
                if (!empty($validatedData['specialitiesSelected'])) {
                    $candidate->specialities()->attach($validatedData['specialitiesSelected']);
                }
                if (!empty($validatedData['fieldsSelected'])) {
                    $candidate->fields()->attach($validatedData['fieldsSelected']);
                }
            } else {
                $candidate = $candidateRepository->update($this->candidate->id, $validatedData);
                if (!empty($validatedData['specialitiesSelected'])) {
                    $candidate->specialities()->sync($validatedData['specialitiesSelected']);
                }
                if (!empty($validatedData['fieldsSelected'])) {
                    $candidate->fields()->sync($validatedData['fieldsSelected']);
                }
            }

            if (!empty($validatedData['files']) && $candidate->exists) {
                $fileRepository->create($this->files, $candidate->id);
            }
            DB::commit();
            $this->reset(['origine', 'commentaire', 'specialitiesSelected', 'fieldsSelected', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'cdt_status', 'position_id', 'files', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);

            return redirect()->route('candidates.show', $candidate->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->action == 'create' ? 'Erreur lors de la création du candidat' : 'Erreur lors de la modification du candidat');
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.form');
    }
}
