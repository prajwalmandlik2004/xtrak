<?php

namespace App\Livewire\Back\Oppdashboard;

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

    public function mount()
    {
        $this->hiredCount = $this->countHired();
        $this->inprogressCount = $this->countInprogress();
        $this->presentedCount = $this->countPresented();
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

    public function render()
    {
        $data = Oppdashboard::orderBy($this->sortField, $this->sortDirection)
            ->paginate(100);

        return view('livewire.back.oppdashboard.admin', [
            'data' => $data
        ]);
    }
}



