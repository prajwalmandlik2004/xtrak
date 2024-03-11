<?php

namespace App\Livewire\Back\Candidates;

use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $candidate;
    #[On('operation:success')]
    public function operationSuccess()
    {
        $this->dispatch('alert', type: 'success', message: 'Operation réussie avec succès');
    }
    public function render()
    {
        return view('livewire.back.candidates.show');
    }
}
