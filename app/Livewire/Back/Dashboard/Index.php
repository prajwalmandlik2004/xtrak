<?php

namespace App\Livewire\Back\Dashboard;

use App\Models\User;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $nbCandidates;
    public $nbUsers;
    public $candidatesRecentsAddeds;
    public $years;
    public $year;
    public $evolutionCandidateByYear;
    public $nbCandidateByMonth;
    public function render()
    {
        return view('livewire.back.dashboard.index');
    }
    public function mount()
    {
        $this->nbCandidates = Candidate::count();
        $this->nbUsers = User::count();
        $this->candidatesRecentsAddeds = Candidate::latest()->take(10)->get();
        $candidateByMonth = Candidate::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as nombre'))->whereYear('created_at', date('Y'))->groupBy('mois')->pluck('nombre', 'mois');
        $this->nbCandidateByMonth = array_replace(array_fill_keys(range(1, 12), 0), $candidateByMonth->toArray());
        $this->years = Helper::years();
        $this->years = Helper::years();
        $candidateByYear = Candidate::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as nombre'))->groupBy('year')->pluck('nombre', 'year');
        $this->evolutionCandidateByYear = array_replace(array_fill_keys($this->years, 0), $candidateByYear->toArray());
        
    }
}
