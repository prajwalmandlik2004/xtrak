<?php

namespace App\Livewire\Back\Trgmcplist;

use Livewire\Component;
use App\Models\TrgMcpLink;
use App\Models\Mcpdashboard;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $datas;
    public $selectedRows = [];
    protected $listeners = ['refreshTable' => '$refresh'];
    public $isEditing = false;
    public $editId = null;
    public $formData = [];
    public $selectAll = false;
    public $step = 1;
    public $action;

    public $search = '';

    public function refreshData()
    {
        $this->datas = TrgMcpLink::latest()->get();
    }

    public function mount()
    {
        $this->refreshData();
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = $this->links->pluck('id')->map(function ($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function toggleSelect($id)
    {
        if (in_array($id, $this->selectedRows)) {
            $this->selectedRows = array_diff($this->selectedRows, [$id]);
        } else {
            $this->selectedRows = [$id];
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            return;
        }

        TrgMcpLink::whereIn('id', $this->selectedRows)->delete();
        $this->selectedRows = [];
        $this->selectAll = false;

        $this->refreshData();

        // session()->flash('message', 'Data Deleted Successfully 🛑');
        $this->dispatch('alert', type: 'success', message: "Data Deleted Successfully");
    }



    public function editRow($id)
    {
        $this->editId = $id;
        $link = TrgMcpLink::with(['opportunity', 'candidate'])->find($id);

        if ($link) {
            $this->formData = $link->toArray();
            $this->isEditing = true;
        } else {
            // session()->flash('message', 'Record not found!');
            $this->dispatch('alert', type: 'error', message: "Record not found!");
        }
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editId = null;
        $this->formData = [];
    }

    public function updateForm()
    {
        $candidateData = $this->formData['candidate'];

        $link = Mcpdashboard::where('mcp_code', $candidateData['mcp_code'])->first();
        if ($link) {
            $link->update([
                'date_mcp' => $candidateData['date_mcp'] ?? null,
                'mcp_code' => $candidateData['mcp_code'] ?? null,
                'designation' => $candidateData['designation'] ?? null,
                'object' => $candidateData['object'] ?? null,
                'tag_source' => $candidateData['tag_source'] ?? null,
                'message' => $candidateData['message'] ?? null,
                'tool' => $candidateData['tool'] ?? null,
                'remarks' => $candidateData['remarks'] ?? null,
                'notes' => $candidateData['notes'] ?? null,
            ]);

            $this->isEditing = false;
            $this->editId = null;
            $this->formData = [];

            $this->refreshData();

            // session()->flash('message', 'Form Updated Successfully ✅');
            $this->dispatch('alert', type: 'success', message: "Form Updated Successfully");
        } else {
            // session()->flash('message', 'Record not found ❌');
            $this->dispatch('alert', type: 'error', message: "Record not found");
        }
    }



    public function deleteMcpLink($linkId)
    {
        TrgMcpLink::find($linkId)->delete();
        // session()->flash('message', 'Link removed successfully ✅');
        $this->dispatch('alert', type: 'success', message: "Link removed successfully");
    }

    public function render()
    {
        $query = TrgMcpLink::with(['opportunity', 'candidate']);


        if (request()->has('selectedRows')) {
            $selectedRows = request()->get('selectedRows');
            $query->whereIn('trg_id', $selectedRows);
        }

        $links = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($this->isEditing) {
            return view('livewire.back.trgmcplist.edit');
        }

        return view('livewire.back.trgmcplist.admin', [
            'links' => $links
        ]);
    }
}


