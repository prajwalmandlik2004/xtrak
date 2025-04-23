<?php

namespace App\Livewire\Back\Oppcstlist;

use Livewire\Component;
use App\Models\OppCstLink;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    
    public function deleteCstLink($linkId)
    {
        OppCstLink::find($linkId)->delete();
        session()->flash('message', 'Link removed successfully ✅');
    }
    
    public function render()
    {
        $query = OppCstLink::with(['opportunity', 'candidate']);
        
        // if ($this->search) {
        //     $query->whereHas('opportunity', function($q) {
        //         $q->where('opp_code', 'like', '%' . $this->search . '%')
        //           ->orWhere('job_titles', 'like', '%' . $this->search . '%');
        //     })->orWhereHas('candidate', function($q) {
        //         $q->where('trg_code', 'like', '%' . $this->search . '%')
        //           ->orWhere('first_name', 'like', '%' . $this->search . '%')
        //           ->orWhere('last_name', 'like', '%' . $this->search . '%');
        //     });
        // }
        
        $links = $query->orderBy('created_at', 'desc')->paginate(10);
            
        return view('livewire.back.oppcstlist.admin', [
            'links' => $links
        ]);
    }
}

