<?php

namespace App\Livewire\Back\Dashboard;

use App\Models\User;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Candidate;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CandidateRepository;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 10;
    public $cdtStatus = '';
    public $candidateStatuses;
    public $filterName = '';
    public $filterDate = '';
    public $state = '';
    public $selectedCandidateId;

    public function selectCandidate($id, $page)
    {
        $this->selectedCandidateId = $id;
        session(['dash_base_cdt_selected_candidate_id' => $id]);
        session(['dash_base_cdt_current_page' => $page]);
        session(['dash_base_cdt_nb_paginate' => $this->nbPaginate]);
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

        return Candidate::with(['position', 'disponibility', 'civ', 'compagny', 'specialities', 'fields'])
            ->where(function ($query) use ($searchFields) {
                $query
                    ->where(function ($query) use ($searchFields) {
                        foreach ($searchFields as $field) {
                            $query->orWhere($field, 'like', '%' . $this->search . '%');
                        }
                    })
                    ->orWhereHas('position', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
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
                    ->orWhereHas('specialities', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('fields', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterName, function ($query) {
                return $query->orderBy('last_name', $this->filterName);
            })
            ->when($this->filterDate, function ($query) {
                return $query->orderBy('created_at', $this->filterDate);
            })
            ->when($this->state, function ($query) {
                $query->where('state', $this->state);
            })
            ->when($this->cdtStatus, function ($query) {
                $query->where('cdt_status', $this->cdtStatus);
            })
            ->paginate($this->nbPaginate);
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function mount()
    {
        $this->candidateStatuses = Helper::candidateStatuses();
        $this->candidateStatuses = Helper::candidateStatuses();
        if (session()->has('dash_base_cdt_selected_candidate_id')) {
            $this->selectedCandidateId = session('dash_base_cdt_selected_candidate_id');
        }

        if (session()->has('dash_base_cdt_current_page')) {
            $this->setPage(session('dash_base_cdt_current_page'));
        }
        if (session()->has('dash_base_cdt_nb_paginate')) {
            $this->nbPaginate = session('dash_base_cdt_nb_paginate');
        }
    }
    public function render()
    {
        return view('livewire.back.dashboard.admin')->with([
            'candidates' => $this->searchCandidates(),
        ]);
    }
}
