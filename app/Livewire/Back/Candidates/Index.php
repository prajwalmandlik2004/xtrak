<?php

namespace App\Livewire\Back\Candidates;

use App\Models\Candidate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
 //   protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 10;
    public function render()
    {
        return view('livewire.back.candidates.index')->with([
            'candidates' => $this->search(),
        ]);
    }

    public function search()
    {
        return Candidate::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->paginate($this->nbPaginate);
    }
}
