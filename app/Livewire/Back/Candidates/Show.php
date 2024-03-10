<?php

namespace App\Livewire\Back\Candidates;

use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $candidate;
    #[On('candidate-created-success')]
    public function candidateCreatedSuccess($resultat)
    {
        $this->dispatch('alert', type: 'success', message: 'Candidat créé avec succès');
    }
    public function render()
    {
        return view('livewire.back.candidates.show');
    }
}
