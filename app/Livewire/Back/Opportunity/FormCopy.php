<?php

namespace App\Livewire\Back\Opportunity;

use App\Models\Civ;
use App\Models\Cre;
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
use Livewire\Attributes\On;
use App\Models\Disponibility;
use Livewire\WithFileUploads;
use App\Models\CandidateState;
use App\Models\CandidateStatut;
use App\Models\NsDate;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Hash;
use App\Repositories\CandidateRepository;

class FormCopy extends Component
{
    public $civs;
    public $civ_id;
    public $source_date;
    public $oppcode;
    public $trgcode;
    public $company_name;
    public $cp;
    public $city_name;
    public $ctc_code;
    public $first_name;
    public $last_name;
    public $function;
    public $job_title;
    public $speciality;
    public $domain;
    public $cp_dpt;
    public $town;
    public $country;
    public $experience;
    public $schooling;
    public $schedules;
    public $mobility;
    public $permit;
    public $type;
    public $vehicle;
    public $date_emb;
    public $annual_gross_one;
    public $annual_gross_two;
    public $skill_one;
    public $skill_two;
    public $skill_three;
    public $others_one;
    public $remarks_one;
    public $advantage_one;
    public $advantage_two;
    public $advantage_three;
    public $others_two;
    public $remarks_three;
    public $autorizeAddCandidate = true;
    public $step = 1;
    public $candidate;

    public function mount()
    {
        $this->civs = Civ::all();
        if ($this->candidate && $this->candidate->exists) {
            $this->civ_id = $this->candidate->civ_id ?? null;
            $this->source_date = $this->candidate->source_date;
            $this->oppcode = $this->candidate->oppcode;
            $this->trgcode = $this->candidate->trgcode;
            $this->company_name = $this->candidate->company_name;
            $this->cp = $this->candidate->cp;
            $this->city_name = $this->candidate->city_name;
            $this->civ_id = $this->candidate->civ_id;
            $this->ctc_code = $this->candidate->ctc_code;
            $this->first_name = $this->candidate->first_name;
            $this->last_name = $this->candidate->last_name;
            $this->function = $this->candidate->function;
            $this->job_title = $this->candidate->job_title;
            $this->speciality = $this->candidate->speciality;
            $this->domain = $this->candidate->domain;
            $this->cp_dpt = $this->candidate->cp_dpt;
            $this->town = $this->candidate->town;
            $this->country = $this->candidate->country;
            $this->experience = $this->candidate->experience;
            $this->schooling = $this->candidate->schooling;
            $this->schedules = $this->candidate->schedules;
            $this->mobility = $this->candidate->mobility;
            $this->permit = $this->candidate->permit;
            $this->type = $this->candidate->type;
            $this->vehicle = $this->candidate->vehicle;
            $this->date_emb = $this->candidate->date_emb;
            $this->annual_gross_one = $this->candidate->annual_gross_one;
            $this->annual_gross_two = $this->candidate->annual_gross_two;
            $this->skill_one = $this->candidate->skill_one;
            $this->skill_two = $this->candidate->skill_two;
            $this->skill_three = $this->candidate->skill_three;
            $this->others_one = $this->candidate->others_one;
            $this->remarks_one = $this->candidate->remarks_one;
            $this->advantage_one = $this->candidate->advantage_one;
            $this->advantage_two = $this->candidate->advantage_two;
            $this->advantage_three = $this->candidate->advantage_three;
            $this->others_two = $this->candidate->others_two;
            $this->remarks_three = $this->candidate->remarks_three;
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
    public function storeCandidateData()
    {
        $validatedData = $this->validate(
            [
                'civs' => 'required',
                'civ_id' => 'required',
                'source_date' => 'nullable',
                'oppcode' => 'nullable',
                'trgcode' => 'nullable',
                'company_name' => 'required',
                'cp' => 'required',
                'city_name' => 'required',
                'ctc_code' => 'nullable',
                'first_name' => 'required',
                'last_name' => 'required',
                'function' => 'required',
                'job_title' => 'required',
                'speciality' => 'nullable',
                'domain' => 'nullable',
                'cp_dpt' => 'required',
                'town' => 'required',
                'country' => 'required',
                'experience' => 'required',
                'schooling' => 'nullable',
                'schedules' => 'nullable',
                'mobility' => 'nullable',
                'permit' => 'nullable',
                'type' => 'nullable',
                'vehicle' => 'nullable',
                'date_emb' => 'nullable',
                'annual_gross_one' => 'nullable',
                'annual_gross_two' => 'required',
                'skill_one' => 'nullable',
                'skill_two' => 'nullable',
                'skill_three' => 'nullable',
                'others_one' => 'nullable',
                'remarks_one' => 'nullable',
                'advantage_one' => 'nullable',
                'advantage_two' => 'nullable',
                'advantage_three' => 'nullable',
                'others_two' => 'nullable',
                'remarks_three' => 'nullable',
            ],
            [
                'first_name.required' => 'Le prénom est obligatoire',
                'last_name.required' => 'Le nom est obligatoire',
                'civ_id.required' => 'La civilité est obligatoire',
                'company_name.required' => 'Le Dénomination sociale est obligatoire',
                'cp.required' => 'Le CP est obligatoire',
                'city_name.required' => 'Le Ville est obligatoire',
                'function.required' => 'Le Fonction est obligatoire',
                'job_title.required' => 'Le Fonction est obligatoire',
                'cp_dpt.required' => 'Le CP/DPT est obligatoire',
                'town.required' => 'Le Town est obligatoire',
                'country.required' => 'Le Country est obligatoire',
                'experience.required' => 'Le Expérience est obligatoire',
                'annual_gross_two.required' => 'Le Brut annuel est obligatoire'
            ],
        );

        DB::beginTransaction();
        $candidateRepository = new CandidateRepository();
        $fileRepository = new FileRepository();

        $this->ensurePositionExists($validatedData);


        if ($validatedData['compagny_id']) {
            $companyName = $validatedData['compagny_id'];
            $company = Compagny::firstOrCreate(['name' => $companyName]);
            $validatedData['compagny_id'] = $company->id;
        } else {
            $validatedData['compagny_id'] = null;
        }

        if ($this->action == 'create') {
            $stateId = CandidateState::where('name', 'Attente')->first()->id;
            $validatedData['candidate_state_id'] = $stateId;
            $validatedData['created_by'] = auth()->user()->id;
            $stringToHash = $validatedData['first_name'] . $validatedData['last_name'] . now();
            $hash = Hash::make($stringToHash);
            $validatedData['code_cdt'] = Str::limit(preg_replace('/[^a-zA-Z0-9]/', '', $hash), 7, '');
            $this->candidate = $candidateRepository->create($validatedData);
        } else {
            $this->candidate = $candidateRepository->update($this->candidate->id, $validatedData);
        }

        DB::commit();
        $this->reset(['origine', 'commentaire', 'speciality_id', 'field_id', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'candidate_statut_id', 'position_id', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);
        $this->step = 2;
        $this->dispatch('alert', type: 'success', message: $this->action == 'create' ? 'Le candidat a été enregistré avec succès.' : 'Le candidat a été modifié avec succès.');
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->action == 'create' ? 'Erreur lors de la création du candidat' : 'Erreur lors de la modification du candidat');
        }
    }

    public function storeCandidateData2()
    {
        $validatedData = $this->validate(
            [
                'civ_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => $this->action == 'create' ? 'required|email|unique:candidates,email' : 'required|email',
                'phone' => 'nullable',
                'compagny_id' => 'nullable',
                'postal_code' => 'nullable',
                'candidate_statut_id' => 'nullable',
                'position_id' => 'required',
                'city' => 'nullable',
                'address' => 'nullable',
                'region' => 'nullable',
                'country' => 'nullable',
                'disponibility_id' => 'nullable',
                'url_ctc' => 'nullable',
                'speciality_id' => 'nullable',
                'field_id' => 'nullable',
                'phone_2' => 'nullable',
                'commentaire' => 'nullable',
                'description' => 'nullable',
                'suivi' => 'nullable',
                'origine' => 'nullable',
                'ns_date_id' => 'nullable',
                'next_step_id' => 'nullable',
            ],
            [
                'first_name.required' => 'Le prénom est obligatoire',
                'last_name.required' => 'Le nom est obligatoire',
                'email.required' => 'L\'email est obligatoire',
                'civ_id.required' => 'La civilité est obligatoire',
                'position_id.required' => 'Le poste est obligatoire',
                'email.unique' => 'Cet email est déjà utilisé',
            ],
        );

        DB::beginTransaction();
        $candidateRepository = new CandidateRepository();
        $fileRepository = new FileRepository();

        // Assurez-vous que la position existe
        $this->ensurePositionExists($validatedData);

        // Assurez-vous que la compagnie existe
        if ($validatedData['compagny_id']) {
            $companyName = $validatedData['compagny_id'];
            $company = Compagny::firstOrCreate(['name' => $companyName]);
            $validatedData['compagny_id'] = $company->id;
        } else {
            $validatedData['compagny_id'] = null;
        }

        if ($this->action == 'create') {
            $stateId = CandidateState::where('name', 'Attente')->first()->id;
            $validatedData['candidate_state_id'] = $stateId;
            $validatedData['created_by'] = auth()->user()->id;
            $stringToHash = $validatedData['first_name'] . $validatedData['last_name'] . now();
            $hash = Hash::make($stringToHash);
            $validatedData['code_cdt'] = Str::limit(preg_replace('/[^a-zA-Z0-9]/', '', $hash), 7, '');
            $this->candidate = $candidateRepository->create($validatedData);
        } else {
            $this->candidate = $candidateRepository->update($this->candidate->id, $validatedData);
        }

        DB::commit();
        $this->reset(['origine', 'commentaire', 'speciality_id', 'field_id', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'candidate_statut_id', 'position_id', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);
        // $this->step = 2;
        $this->dispatch('alert', type: 'success', message: $this->action == 'create' ? 'Le candidat a été enregistré avec succès.' : 'Le candidat a été modifié avec succès.');
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->action == 'create' ? 'Erreur lors de la création du candidat' : 'Erreur lors de la modification du candidat');
        }
    }



    public function updateCandidateState()
    {
        $stateId = CandidateState::where('name', 'Certifié')->first()->id;
        if ($stateId != $this->candidate->candidate_state_id && $this->candidate->files()->exists()) {
            $cvFile = $this->candidate->files()->where('file_type', 'cv')->first();
            $additionalFieldsFilled = $this->candidate->first_name && $this->candidate->last_name && $this->candidate->civ_id && $this->candidate->email && $this->candidate->position_id;
            if ($cvFile && $additionalFieldsFilled) {
                $certificate = Helper::generateCandidateCertificate();
                $this->candidate->update([
                    'certificate' => $certificate,
                    'candidate_state_id' => $stateId,
                ]);
            }
        }
    }
    public function storeCre()
    {
        $questions = [
            1 => ' Statut professionnel',
            2 => 'Statut personnel',
            3 => 'Situation professionnelle',
            4 => 'Points incontournables',
            5 => 'Savoir-être du candidat',
            6 => 'Prise de référence(s)',
            7 => 'Prétentions salariales',
            8 => 'Disponibilités candidat',
            9 => 'Résumé du parcours professionnel',
        ];

        $validatedData = $this->validate([
            'response1' => 'nullable',
            'response2' => 'nullable',
            'response3' => 'nullable',
            'response4' => 'nullable',
            'response5' => 'nullable',
            'response6' => 'nullable',
            'response7' => 'nullable',
            'response8' => 'nullable',
            'response9' => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            foreach ($validatedData as $key => $value) {
                $number = substr($key, strlen('response'));
                Cre::create([
                    'response' => $value,
                    'number' => $number,
                    'candidate_id' => $this->candidate->id,
                    'question' => $questions[$number],
                ]);
            }
            $this->candidate->update([
                'cre_ref' => 'CRE' . rand(1, 99999),
                'cre_created_at' => now(),
            ]);
            $this->updateCandidateState();
            DB::commit();
            return redirect()
                ->route('opportunity.show', $this->candidate->id)
                ->with('success', 'Le candidat a été enregistré avec succès.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->action == 'create' ? 'Erreur lors de la création du c.r.e' : 'Erreur lors de la modification du c.r.e');
        }
    }

    public function endCreate()
    {
        $this->updateCandidateState();
        return redirect()
            ->route('opportunity.show', $this->candidate->id)
            ->with('success', 'Le candidat a été enregistré avec succès.');
    }
    public function goToCre()
    {
        $this->step = 3;
    }
    public function goToForm()
    {
        $this->civs = Civ::all();
        if ($this->candidate && $this->candidate->exists) {
            $this->civ_id = $this->candidate->civ_id ?? null;
            $this->source_date = $this->candidate->source_date;
            $this->oppcode = $this->candidate->oppcode;
            $this->trgcode = $this->candidate->trgcode;
            $this->company_name = $this->candidate->company_name;
            $this->cp = $this->candidate->cp;
            $this->city_name = $this->candidate->city_name;
            $this->civ_id = $this->candidate->civ_id;
            $this->ctc_code = $this->candidate->ctc_code;
            $this->first_name = $this->candidate->first_name;
            $this->last_name = $this->candidate->name;
            $this->function = $this->candidate->function;
            $this->job_title = $this->candidate->job_title;
            $this->speciality = $this->candidate->speciality;
            $this->domain = $this->candidate->domain;
            $this->cp_dpt = $this->candidate->cp_dpt;
            $this->town = $this->candidate->town;
            $this->country = $this->candidate->country;
            $this->experience = $this->candidate->experience;
            $this->schooling = $this->candidate->schooling;
            $this->schedules = $this->candidate->schedules;
            $this->mobility = $this->candidate->mobility;
            $this->permit = $this->candidate->permit;
            $this->type = $this->candidate->type;
            $this->vehicle = $this->candidate->vehicle;
            $this->date_emb = $this->candidate->date_emb;
            $this->annual_gross_one = $this->candidate->annual_gross_one;
            $this->annual_gross_two = $this->candidate->annual_gross_two;
            $this->skill_one = $this->candidate->skill_one;
            $this->skill_two = $this->candidate->skill_two;
            $this->skill_three = $this->candidate->skill_three;
            $this->others_one = $this->candidate->others_one;
            $this->remarks_one = $this->candidate->remarks_one;
            $this->advantage_one = $this->candidate->advantage_one;
            $this->advantage_two = $this->candidate->advantage_two;
            $this->advantage_three = $this->candidate->advantage_three;
            $this->others_two = $this->candidate->others_two;
            $this->remarks_three = $this->candidate->remarks_three;
        }
    }

    public function resetForm()
    {
        $this->reset(['next_step_id', 'ns_date_id', 'origine', 'commentaire', 'description', 'suivi', 'speciality_id', 'field_id', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'candidate_statut_id', 'position_id', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);
    }
    public $new_position;

    public function render()
    {
        return view('livewire.back.opportunity.form');
    }
    protected function ensurePositionExists(&$validatedData)
    {
        if ($validatedData['position_id']) {
            $positionName = $validatedData['position_id'];
            $position = Position::firstOrCreate(['name' => $positionName]);
            $validatedData['position_id'] = $position->id;
        } else {
            $validatedData['position_id'] = null;
        }
    }
}
