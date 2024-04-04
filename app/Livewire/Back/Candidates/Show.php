<?php

namespace App\Livewire\Back\Candidates;

use App\Models\Civ;
use App\Models\Field;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Compagny;
use App\Models\NextStep;
use App\Models\Position;
use App\Models\Speciality;
use Livewire\Attributes\On;
use App\Models\Disponibility;
use App\Models\CandidateState;
use App\Models\CandidateStatut;
use Illuminate\Support\Facades\DB;
use App\Repositories\CandidateRepository;

class Show extends Component
{
    public $candidate;
    public $candidateStates;
    public $candidate_state_id;
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
    public $created_by;
    public $city;
    public $address;
    public $region;
    public $country;
    public $disponibilities;
    public $disponibility_id;
    public $url_ctc;
    public $specialities;
    public $specialitiesSelected = [];
    public $fields;
    public $fieldsSelected = [];
    public $compagnies;
    public $commentaire;
    public $origine;
    public $nextSteps;
    public $next_step_id;
    public $ns_date;
    public $candidateStatuses;
    #[On('deleteCandidate')]
    public function deleteData($id)
    {
        $candidateRepository = new CandidateRepository();
        DB::beginTransaction();
        $candidate = $candidateRepository->find($id);

        $candidateRepository->delete($candidate->id);
        DB::commit();
        return redirect()->route('candidates.index')->with('success', 'le candidat est supprimé avec succès');
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer le candidat $candidate->first_name. $candidate->laste_name");
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'deleteCandidate', id: $id);
    }
    #[On('showsuccess')]
    public function showSuccess($candidate)
    {
        $this->dispatch('alert', type: 'error', message: 'Erreur lors de la modification du candidat');
    }
    public function mount()
    {
        $this->candidateStates = CandidateState::all();
        $this->candidateStatuses = CandidateStatut::all();
        $this->candidate_state_id = $this->candidate->candidateState->id ?? '';
        $this->nextSteps = NextStep::all();
        $this->civs = Civ::all();
        $this->disponibilities = Disponibility::all();
        $this->positions = Position::orderBy('name', 'asc')->get();
        $this->specialities = Speciality::orderBy('name', 'asc')->get();
        $this->fields = Field::orderBy('name', 'asc')->get();
        $this->compagnies = Compagny::orderBy('name', 'asc')->get();
        if ($this->candidate && $this->candidate->exists) {
            $this->civ_id = $this->candidate->civ->id ?? null;
            $this->first_name = $this->candidate->first_name;
            $this->last_name = $this->candidate->last_name;
            $this->email = $this->candidate->email;
            $this->phone = $this->candidate->phone;
            $this->compagny_id = $this->candidate->compagny->id ?? null;
            $this->postal_code = $this->candidate->postal_code;
            $this->candidate_statut_id = $this->candidate->candidateStatut->id ?? null;
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
    public function storeData()
    {
        $validatedData = $this->validate(
            [
                'civ_id' => 'nullable',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'nullable',
                'compagny_id' => 'nullable',
                'postal_code' => 'nullable',
                'candidate_statut_id' => 'nullable',
                'position_id' => 'nullable',
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

        DB::beginTransaction();
        $candidateRepository = new CandidateRepository();
        $this->candidate = $candidateRepository->update($this->candidate->id, $validatedData);
        if (!empty($validatedData['specialitiesSelected'])) {
            $this->candidate->specialities()->sync($validatedData['specialitiesSelected']);
        }
        if (!empty($validatedData['fieldsSelected'])) {
            $this->candidate->fields()->sync($validatedData['fieldsSelected']);
        }
        DB::commit();
        $this->mount();
        // $this->reset(['origine', 'commentaire', 'specialitiesSelected', 'fieldsSelected', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'candidate_statut_id', 'position_id', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc']);
        $this->dispatch('alert', type: 'success', message: 'Candidat modifié avec succès');
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Erreur lors de la modification du candidat');
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.show');
    }
    public function updatedState($id)
    {
        $this->candidate->candidate_state_id = CandidateState::where('id', $id)->first()->id;
        $this->candidate->save();
        $this->dispatch('alert', type: 'success', message: 'Etat modifier avec succès');
    }
}
