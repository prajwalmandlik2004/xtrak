<?php

namespace App\Livewire\Back\Candidates\Import;

use Livewire\Component;
use Livewire\Attributes\On;

class Result extends Component
{
    public $rejected = [];
    public $accepted = [];
    #[On('data-from-import')]
    public function dataFromImport($accepted, $rejected)
    {
        
        $this->accepted = $accepted;
        $this->rejected = $rejected;
      
    }
    public function render()
    {
        return view('livewire.back.candidates.import.result');
    }
}
