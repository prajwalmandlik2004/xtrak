<?php

namespace App\Livewire\Back\Dashboard;

use App\Models\User;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Candidate;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $filterName = '';
    public $filterDate = '';
    public $state = '';
    public $cdtStatus = '';
    public $candidateStatuses;
    public function render()
    {
        return view('livewire.back.dashboard.admin')->with([
            'candidates' => $this->searchCandidates(),
        ]);
    }
    public function mount()
    {
        $this->candidateStatuses = Helper::candidateStatuses();
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
            ->latest()
            ->take(10)
            ->get();
    }
}
