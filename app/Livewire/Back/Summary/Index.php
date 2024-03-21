<?php

namespace App\Livewire\Back\Summary;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::orderBy('last_seen', 'DESC')->get();
    }
    public function render()
    {
        return view('livewire.back.summary.index');
    }
}
