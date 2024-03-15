<?php

namespace App\Livewire\Back\Candidates;

use Livewire\Component;
use App\Models\Candidate;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CandidateRepository;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 50;
    public $cdtStatus = '';
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
            $query->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%');
        })
        ->when(Auth::user()->hasRole('Administrateur'), function ($query) {
            return $query;
        }, function ($query) {
            return $query->where('created_by', Auth::id());
        })
        ->when($this->cdtStatus, function ($query) {
            return $query->where('cdt_status', $this->cdtStatus);
        })
        ->orderBy('last_name', 'asc')
        ->paginate($this->nbPaginate);
    }
    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function render()
    {
        return view('livewire.back.candidates.index')->with([
            'candidates' => $this->searchCandidates(),
        ]);
    }
}
