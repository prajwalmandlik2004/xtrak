<?php

namespace App\Livewire\Back\Candidates;

use App\Models\Civ;
use App\Models\File;
use App\Models\Field;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Compagny;
use App\Models\NextStep;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Speciality;
use Illuminate\Support\Str;
use App\Models\Disponibility;
use Livewire\WithFileUploads;
use App\Models\CandidateStatut;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Hash;
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
    public $candidate_statut_id;
    public $position_id;
    public $positions;
    public $candidate;
    public $created_by;
    public $autorizeAddCandidate = true;
    public $action;
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
    public $candidateStatuses;
    public $cv;
    public $cover_letter;
    public function mount()
    {
        $this->candidateStatuses = CandidateStatut::all();
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
            $this->compagny_id = $this->candidate->compagny->id ?? '';
            $this->postal_code = $this->candidate->postal_code;
            $this->candidate_statut_id = $this->candidate->candidateStatut->candidate_statut_id ?? '';
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
        if (!empty($this->email)) {
            $existingCandidate = Candidate::when($this->first_name, function ($query) {
                $query->where('first_name', $this->first_name);
            })
                ->when($this->email, function ($query) {
                    $query->where('email', $this->email);
                })
                ->where('last_name', $this->last_name)
                ->exists();

            if ($existingCandidate) {
                $this->autorizeAddCandidate = false;
                if (!empty($this->first_name)) {
                    $this->addError('first_name', 'Candidat déja enregistré.');
                }
                if (!empty($this->last_name)) {
                    $this->addError('last_name', 'Candidat déja enregistré.');
                }
                if (!empty($this->email)) {
                    $this->addError('email', 'Candidat déja enregistré.');
                }
            } else {
                $this->autorizeAddCandidate = true;
                $this->resetErrorBag(['first_name', 'last_name', 'email']);
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
                'email' => $this->action == 'create' ? 'required|email|unique:candidates,email' : 'required|email',
                'phone' => 'nullable',
                'compagny_id' => 'nullable',
                'postal_code' => 'nullable',
                'candidate_statut_id' => 'nullable',
                'position_id' => 'nullable',
                'cv' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                'cover_letter' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
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
                'first_name.required' => 'Le prénom est obligatoire',
                'last_name.required' => 'Le nom est obligatoire',
                'email.required' => 'L\'email est obligatoire',
            ],
        );
        try {
            DB::beginTransaction();
            $candidateRepository = new CandidateRepository();
            $fileRepository = new FileRepository();
            if ($this->action == 'create') {
                $validatedData['created_by'] = auth()->user()->id;
                if (!empty($validatedData['cv'])) {
                    $validatedData['certificate'] = Str::random(10);
                    $validatedData['state'] = 'Certifié';
                }
                $stringToHash = $validatedData['first_name'] . $validatedData['last_name'] . now();
                $hash=  Hash::make($stringToHash); 
                $validatedData['code_cdt'] =  Str::limit(preg_replace('/[^a-zA-Z0-9]/', '', $hash), 7, '');
                $candidate = $candidateRepository->create($validatedData);
                if (!empty($validatedData['specialitiesSelected'])) {
                    $candidate->specialities()->attach($validatedData['specialitiesSelected']);
                }
                if (!empty($validatedData['fieldsSelected'])) {
                    $candidate->fields()->attach($validatedData['fieldsSelected']);
                }
            } else {
                if ($this->candidate->files()->exists()) {
                    $cvFile = $this->candidate->files()->where('file_type', 'cv')->first();
                    if (!$cvFile && !empty($validatedData['cv'])) {
                        $validatedData['certificate'] = Str::random(10);
                        $validatedData['state'] = 'Certifié';
                    }
                }
                $candidate = $candidateRepository->update($this->candidate->id, $validatedData);
                if (!empty($validatedData['specialitiesSelected'])) {
                    $candidate->specialities()->sync($validatedData['specialitiesSelected']);
                }
                if (!empty($validatedData['fieldsSelected'])) {
                    $candidate->fields()->sync($validatedData['fieldsSelected']);
                }
            }

            if (!empty($validatedData['cv']) && $candidate->exists) {
                $fileRepository->createOne($validatedData['cv'], $candidate->id, 'cv');
            }
            if (!empty($validatedData['cover_letter']) && $candidate->exists) {
                $fileRepository->createOne($validatedData['cover_letter'], $candidate->id, 'cover letter');
            }
            DB::commit();
            $this->reset(['origine', 'commentaire', 'specialitiesSelected', 'fieldsSelected', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'candidate_statut_id', 'position_id', 'cv', 'cover_letter', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);

            return redirect()->route('candidates.show', $candidate->id)->with('success', 'Le candidat a été enregistré avec succès.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->action == 'create' ? 'Erreur lors de la création du candidat' : 'Erreur lors de la modification du candidat');
        }
    }
    public function resetForm()
    {
        $this->reset(['origine', 'commentaire', 'specialitiesSelected', 'fieldsSelected', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'candidate_statut_id', 'position_id', 'cv', 'cover_letter', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);
    }
    public function render()
    {
        return view('livewire.back.candidates.form');
    }
}
