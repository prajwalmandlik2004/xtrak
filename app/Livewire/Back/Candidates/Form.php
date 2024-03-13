<?php

namespace App\Livewire\Back\Candidates;

use App\Models\File;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Field;
use App\Models\Speciality;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;
use App\Repositories\CandidateRepository;

class Form extends Component
{
    use WithFileUploads;
    public $title;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $company;
    public $postal_code;
    public $cdt_status;
    public $position_id;
    public $positions;
    public $candidate;
    public $created_by;
    public $candidateTitles;
    public $autorizeAddCandidate = true;
    public $action;
    public $files = [];
    public $city;
    public $address;
    public $region;
    public $country;
    public $availability;
    public $url_ctc;
    public $availabilities;
    public $specialities;
    public $specialitiesSelected;
    public $fields;
    public $fieldsSelected;

    public function mount()
    {
        $this->candidateTitles = Helper::candidateTitles();
        $this->availabilities = Helper::candidateAvailabilities();
        $this->positions = Position::orderBy('name', 'asc')->get();
        $this->specialities = Speciality::orderBy('name', 'asc')->get();
        $this->fields = Field::orderBy('name', 'asc')->get(); 
        if ($this->candidate && $this->candidate->exists) {
            $this->title = $this->candidate->title;
            $this->first_name = $this->candidate->first_name;
            $this->last_name = $this->candidate->last_name;
            $this->email = $this->candidate->email;
            $this->phone = $this->candidate->phone;
            $this->company = $this->candidate->company;
            $this->postal_code = $this->candidate->postal_code;
            $this->cdt_status = $this->candidate->cdt_status;
            $this->position_id = $this->candidate->position_id;
            $this->city = $this->candidate->city;
            $this->address = $this->candidate->address;
            $this->region = $this->candidate->region;
            $this->country = $this->candidate->country;
            $this->availability = $this->candidate->availability;
            $this->url_ctc = $this->candidate->url_ctc;
            $this->specialitiesSelected = $this->candidate->specialties->pluck('id')->toArray() ?? [];
            $this->fieldsSelected = $this->candidate->fields->pluck('id')->toArray() ?? [];
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
                // ->when($this->last_name, function ($query) {
                //     $query->where('last_name', $this->last_name);
                // })
                ->when($this->email, function ($query) {
                    $query->where('email', $this->email);
                })
                ->when($this->phone, function ($query) {
                    $query->where('phone', $this->phone);
                })
                ->when($this->company, function ($query) {
                    $query->where('company', $this->company);
                })
                ->when($this->postal_code, function ($query) {
                    $query->where('postal_code', $this->postal_code);
                })
                ->when($this->cdt_status, function ($query) {
                    $query->where('cdt_status', $this->cdt_status);
                })
                ->when($this->title, function ($query) {
                    $query->where('title', $this->title);
                })
                ->when($this->city, function ($query) {
                    $query->where('city', $this->city);
                })
                ->when($this->address, function ($query) {
                    $query->where('address', $this->address);
                })
                ->when($this->region, function ($query) {
                    $query->where('region', $this->region);
                })
                ->when($this->country, function ($query) {
                    $query->where('country', $this->country);
                })
                ->when($this->availability, function ($query) {
                    $query->where('availability', $this->availability);
                })
                ->when($this->url_ctc, function ($query) {
                    $query->where('url_ctc', $this->url_ctc);
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
                if (!empty($this->company)) {
                    $this->addError('company', 'Ce candidat existe déjà.');
                }
                if (!empty($this->postal_code)) {
                    $this->addError('postal_code', 'Ce candidat existe déjà.');
                }
                if (!empty($this->email)) {
                    $this->addError('email', 'Ce candidat existe déjà.');
                }
                if (!empty($this->cdt_status)) {
                    $this->addError('cdt_status', 'Ce candidat existe déjà.');
                }
                if (!empty($this->position_id)) {
                    $this->addError('position_id', 'Ce candidat existe déjà.');
                }
                if (!empty($this->title)) {
                    $this->addError('title', 'Ce candidat existe déjà.');
                }
                if (!empty($this->city)) {
                    $this->addError('city', 'Ce candidat existe déjà.');
                }
                if (!empty($this->address)) {
                    $this->addError('address', 'Ce candidat existe déjà.');
                }
                if (!empty($this->region)) {
                    $this->addError('region', 'Ce candidat existe déjà.');
                }
                if (!empty($this->country)) {
                    $this->addError('country', 'Ce candidat existe déjà.');
                }
                if (!empty($this->availability)) {
                    $this->addError('availability', 'Ce candidat existe déjà.');
                }
                if (!empty($this->url_ctc)) {
                    $this->addError('url_ctc', 'Ce candidat existe déjà.');
                }
            } else {
                $this->autorizeAddCandidate = true;
                $this->resetErrorBag(['first_name', 'last_name', 'email', 'phone', 'company', 'postal_code', 'cdt_status', 'position_id', 'title', 'city', 'address', 'region', 'country', 'availability', 'url_ctc']);
            }
        }
    }

    public function storeData()
    {
        $validatedData = $this->validate(
            [
                'title' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:candidates,email',
                'phone' => 'required',
                'company' => 'required',
                'postal_code' => 'required',
                'cdt_status' => 'required',
                'position_id' => 'required',
                'files' => 'nullable',
                'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:2048',
                'city' => 'nullable',
                'address' => 'nullable',
                'region' => 'nullable',
                'country' => 'nullable',
                'availability' => 'nullable',
                'url_ctc' => 'nullable',
                'specialitiesSelected' => 'nullable',
                'fieldsSelected' => 'nullable',
            ],
            [
                'title.required' => 'Le titre est obligatoire',
                'first_name.required' => 'Le prénom est obligatoire',
                'last_name.required' => 'Le nom est obligatoire',
                'email.required' => 'L\'email est obligatoire',
                'email.email' => 'L\'email doit être une adresse email valide',
                'phone.required' => 'Le téléphone est obligatoire',
                'company.required' => 'La société est obligatoire',
                'postal_code.required' => 'Le code postal est obligatoire',
                'cdt_status.required' => 'Le statut est obligatoire',
                'position_id.required' => 'Le poste est obligatoire',
                'email.unique' => 'Cet email existe déjà. Veuillez en saisir un autre.',
            ],
        );
        DB::beginTransaction();
        $candidateRepository = new CandidateRepository();
        $fileRepository = new FileRepository();
        if ($this->action == 'create') {
            $validatedData['created_by'] = auth()->user()->id;
            $validatedData['certificate'] = Str::random(10);
            $candidate = $candidateRepository->create($validatedData);
            if (!empty($validatedData['specialitiesSelected'])) {
                $candidate->specialties()->attach($validatedData['specialitiesSelected']);
            }
            if (!empty($validatedData['fieldsSelected'])) {
                $candidate->fields()->attach($validatedData['fieldsSelected']);
            }
        } else {
            $candidate = $candidateRepository->update($this->candidate->id, $validatedData);
        }

        if (!empty($validatedData['files']) && $candidate->exists) {
            $fileRepository->create($this->files, $candidate->id);
        }
        DB::commit();
        $this->reset(['title', 'first_name', 'last_name', 'email', 'phone', 'company', 'postal_code', 'cdt_status', 'position_id', 'files', 'city', 'address', 'region', 'country', 'availability', 'url_ctc']);
        $this->dispatch('operation:success');
        return redirect()->route('candidates.show', $candidate->id);
        try {
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
