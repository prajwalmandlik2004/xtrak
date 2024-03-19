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
    // public $nbUsers;
    // public $candidatesRecentsAddeds;
    // public $years;
    // public $year;
    // public $evolutionCandidateByYear;
    // public $nbCandidateByMonth;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 10;
    public $filterName = '';
    public $filterDate = '';
    public $state = '';
    public $cdtStatus = '';
    public function render()
    {
        return view('livewire.back.dashboard.admin')->with([
            'candidates' => $this->searchCandidates(),
        ]);
    }
    public function mount()
    {
        // $this->nbUsers = User::count();
        // $this->candidatesRecentsAddeds = Candidate::when(!Auth::user()->hasRole('Administrateur'), function ($query) {
        //     return $query->where('created_by', Auth::id());
        // })
        //     ->latest()
        //     ->take(10)
        //     ->get();
        // $candidateByMonth = Candidate::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as nombre'))->whereYear('created_at', date('Y'))->groupBy('mois')->pluck('nombre', 'mois');
        // $this->nbCandidateByMonth = array_replace(array_fill_keys(range(1, 12), 0), $candidateByMonth->toArray());
        // $this->years = Helper::years();
        // $this->years = Helper::years();
        // $candidateByYear = Candidate::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as nombre'))->groupBy('year')->pluck('nombre', 'year');
        // $this->evolutionCandidateByYear = array_replace(array_fill_keys($this->years, 0), $candidateByYear->toArray());
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
            ->when($this->cdtStatus, function ($query) {
                return $query->where('cdt_status', $this->cdtStatus);
            })
            ->paginate($this->nbPaginate);
    }
}
