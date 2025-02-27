<?php

namespace App\Livewire\Back\Oppdashboard;

use App\Models\Ctcdashboard;
use App\Models\Oppdashboard;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';
    public $selectAll = false;
    public $hiredCount;
    public $inprogressCount;
    public $presentedCount;

    // Filter : 
    public $select = false;
    public $search = '';
    public $codeopp = '';
    public $libelle = '';
    public $company = '';
    public $statut = '';
    public $position = '';
    public $remarks = '';

    public function resetFilters()
    {
        $this->select = false;
        $this->search = '';
        $this->codeopp = '';
        $this->libelle = '';
        $this->company = '';
        $this->statut = '';
        $this->position = '';
        $this->remarks = '';
    }
    public function mount()
    {
        $this->hiredCount = $this->countHired();
        $this->inprogressCount = $this->countInprogress();
        $this->presentedCount = $this->countPresented();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function countHired()
    {
        return Oppdashboard::where('opportunity_status', 'HIRED')->count();
    }

    public function countInprogress()
    {
        return Oppdashboard::where('opportunity_status', 'En cours')->count();
    }

    public function countPresented()
    {
        return Oppdashboard::where('opportunity_status', 'Presented')->count();
    }

    public function render()
    {
        $query = Oppdashboard::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('opportunity_date', 'like', '%' . $this->search . '%')
                    ->orWhere('opp_code', 'like', '%' . $this->search . '%')
                    ->orWhere('job_titles', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('postal_code_1', 'like', '%' . $this->search . '%')
                    ->orWhere('site_city', 'like', '%' . $this->search . '%')
                    ->orWhere('opportunity_status', 'like', '%' . $this->search . '%')
                    ->orWhere('remarks', 'like', '%' . $this->search . '%')
                    ->orWhere('trg_code', 'like', '%' . $this->search . '%')
                    ->orWhere('total_paid', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->codeopp) {
            $query->where('opp_code', 'like', '%' . $this->codeopp . '%');
        }

        if ($this->libelle) {
            $query->where('job_titles', 'like', '%' . $this->libelle . '%');
        }

        if ($this->company) {
            $query->where('name', 'like', '%' . $this->company . '%');
        }

        if ($this->statut !== '') {
            if ($this->statut == 'Open') {
                $query->where('opportunity_status', 'Open');
            } else if ($this->statut == 'Closed') {
                $query->where('opportunity_status', 'Closed');
            } else if ($this->statut == 'Filled') {
                $query->where('opportunity_status', 'Filled');
            }
        }

        if ($this->position) {
            $query->where('postal_code_1', 'like', '%' . $this->position . '%');
        }

        if ($this->remarks) {
            $query->where('remarks', 'like', '%' . $this->remarks . '%');
        }


        // $data = Oppdashboard::orderBy($this->sortField, $this->sortDirection)
        //     ->paginate(100);

        $data = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate(100);

        return view('livewire.back.oppdashboard.admin', [
            'data' => $data
        ]);
    }
}



