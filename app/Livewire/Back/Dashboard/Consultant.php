<?php

namespace App\Livewire\Back\Dashboard;

use Livewire\Component;
use App\Models\Candidate;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CandidateRepository;

class Consultant extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 10;
    public $filterName = '';
    public $filterDate = '';
    public $state = '';
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
        return Candidate::where(function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')->orWhere('last_name', 'like', '%' . $this->search . '%');
        })
            ->when($this->filterName, function ($query) {
                return $query->orderBy('last_name', $this->filterName);
            })
            ->when($this->filterDate, function ($query) {
                return $query->orderBy('created_at', $this->filterDate);
            })
            ->when($this->state, function ($query) {
                return $query->where('state', $this->state);
            })
            ->where('created_by', Auth::id())
            ->paginate($this->nbPaginate);
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function render()
    {
        return view('livewire.back.dashboard.consultant')->with([
            'candidates' => $this->searchCandidates(),
        ]);
    }
}
