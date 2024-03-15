<?php

namespace App\Livewire\Back\Candidates;

use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $candidate;
    #[On('showsuccess')]
    public function showSuccess($candidate)
    {
        dd($candidate);
        // $this->dispatch('alert', type: 'success', message: 'Operation réussie avec succès');
        $this->dispatch('alert', type: 'error', message:  'Erreur lors de la modification du candidat');

      
    }
   
    public function render()
    {
        return view('livewire.back.candidates.show');
    }
}
