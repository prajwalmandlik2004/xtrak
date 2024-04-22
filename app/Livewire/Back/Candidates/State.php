<?php

namespace App\Livewire\Back\Candidates;

use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\CandidateState;
use App\Models\CandidateStatut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CandidateRepository;

class State extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 10;
    public $candidate_statut_id = '';
    public $filterName = '';
    public $filterDate = '';
    public $candidate_state_id = '';
    public $candidateStatuses;
    public $selectedCandidateId;
    public $candidateStates;
    public $state;
    public $positions;
    public $position_id;
    public function selectCandidate($id, $page)
    {
        $this->selectedCandidateId = $id;
        session(['state_selected_candidate_id_' . $this->candidate_state_id => $id]);
        session(['state_current_page_' . $this->candidate_state_id => $page]);
        session(['state_nb_paginate_' . $this->candidate_state_id => $this->nbPaginate]);
        return redirect()->route('candidates.show', $id);
    }
    #[On('delete')]
    public function deleteData($id)
    {
        $candidateRepository = new CandidateRepository();
        DB::beginTransaction();
        $candidate = $candidateRepository->find($id);
        try {
            $candidateRepository->delete($candidate->id);
            DB::commit();
            $this->dispatch('alert', type: 'success', message: 'le candidat est supprimé avec succès');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer le candidat $candidate->first_name. $candidate->laste_name");
        }
    }
    public function searchCandidates()
    {
        $searchFields = ['first_name', 'last_name', 'email', 'phone', 'postal_code', 'city', 'address', 'region', 'country'];
        //if user hasrole Administrateur he can see all candidates
        if (Auth::user()->hasRole('Administrateur')) {
            return Candidate::with(['position', 'disponibility', 'civ', 'compagny', 'speciality', 'field'])
                ->where(function ($query) use ($searchFields) {
                    $query
                        ->where(function ($query) use ($searchFields) {
                            foreach ($searchFields as $field) {
                                $query->orWhere($field, 'like', '%' . $this->search . '%');
                            }
                        })

                        ->orWhereHas('disponibility', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('civ', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('compagny', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('speciality', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('field', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->when($this->filterName, function ($query) {
                    return $query->orderBy('last_name', $this->filterName);
                })
                ->when($this->filterDate, function ($query) {
                    return $query->orderBy('created_at', $this->filterDate);
                })
                ->when($this->candidate_state_id, function ($query) {
                    $query->where('candidate_state_id', $this->candidate_state_id);
                })
                ->when($this->candidate_statut_id, function ($query) {
                    $query->where('candidate_statut_id', $this->candidate_statut_id);
                })
                ->when($this->position_id, function ($query) {
                    $query->where('position_id', $this->position_id);
                })
                ->paginate($this->nbPaginate);
        } else {
            return Candidate::with(['position', 'disponibility', 'civ', 'compagny', 'speciality', 'field'])
                ->where(function ($query) use ($searchFields) {
                    $query
                        ->where(function ($query) use ($searchFields) {
                            foreach ($searchFields as $field) {
                                $query->orWhere($field, 'like', '%' . $this->search . '%');
                            }
                        })

                        ->orWhereHas('disponibility', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('civ', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('compagny', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('speciality', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('field', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->when($this->filterName, function ($query) {
                    return $query->orderBy('last_name', $this->filterName);
                })
                ->when($this->filterDate, function ($query) {
                    return $query->orderBy('created_at', $this->filterDate);
                })
                ->when($this->candidate_state_id, function ($query) {
                    $query->where('candidate_state_id', $this->candidate_state_id);
                })
                ->when($this->candidate_statut_id, function ($query) {
                    $query->where('candidate_statut_id', $this->candidate_statut_id);
                })
                ->when($this->position_id, function ($query) {
                    $query->where('position_id', $this->position_id);
                })
                ->where('created_by', Auth::id())
                ->paginate($this->nbPaginate);
        }
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'delete', id: $id);
    }

    public function mount()
    {
        $this->positions = Position::all();
        $this->candidateStatuses = CandidateStatut::all();
        $this->candidateStates = CandidateState::all();
        $this->candidate_state_id = CandidateState::where('name', $this->state)->first()->id;
        if (session()->has('state_selected_candidate_id_' . $this->candidate_state_id)) {
            $this->selectedCandidateId = session('state_selected_candidate_id_' . $this->candidate_state_id);
        }

        if (session()->has('state_current_page_' . $this->candidate_state_id)) {
            $this->setPage(session('state_current_page_' . $this->candidate_state_id));
        }
        if (session()->has('state_nb_paginate_' . $this->candidate_state_id)) {
            $this->nbPaginate = session('state_nb_paginate_' . $this->candidate_state_id);
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.state')->with([
            'candidates' => $this->searchCandidates(),
        ]);
    }
}
