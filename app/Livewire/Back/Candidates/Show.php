<?php

namespace App\Livewire\Back\Candidates;

use App\Helpers\Helper;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $candidate;
    public $candidateStates;
    public $state;

    #[On('showsuccess')]
    public function showSuccess($candidate)
    {
        $this->dispatch('alert', type: 'error', message: 'Erreur lors de la modification du candidat');
    }
    public function mount()
    {
        $this->candidateStates = Helper::candidateState();
        $this->state =  $this->candidate->state;
    }

    public function render()
    {
        return view('livewire.back.candidates.show');
    }
    public function updatedState($state)
    {
        $this->candidate->state = $state;
        $this->candidate->save();
        $this->dispatch('alert', type: 'success', message: 'Etat modifier avec succès');
    }
}
