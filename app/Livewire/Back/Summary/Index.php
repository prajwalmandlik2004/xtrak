<?php

namespace App\Livewire\Back\Summary;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    // #[On('userActivityUpdated')]
    // public function updateUserStatus()
    // {
    //     $this->update();
    // }
    protected $listeners = ['userActivityUpdated' => '$refresh'];
    public function render()
    {
        return view('livewire.back.summary.index')->with([
            'users' => User::all(),
        ]);
    }
}
