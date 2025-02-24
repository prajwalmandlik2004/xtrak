<?php

namespace App\Livewire\Back\Trgdashboard;

use Livewire\Component;
use \App\Models\Trgdashboard;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $data;

    public function mount()
    {
        $this->data = Trgdashboard::all();
    }

    public function render()
    {
        return view('livewire.back.trgdashboard.admin');
    }
}




