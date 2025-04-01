<?php

namespace App\Livewire\Back\Cstdashboard;

use App\Models\Cstdashboard;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';
    public $selectAll = false;

    public $datas;
    public $selectedRows = [];
    protected $listeners = ['refreshTable' => '$refresh'];
    public $isEditing = false;
    public $editId = null;
    public $formData = [];


    public function refreshData()
    {
        $this->datas = Cstdashboard::latest()->get();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = $this->data->pluck('id')->map(function ($id) {
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
            $this->selectedRows[] = $id;
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            return;
        }

        Cstdashboard::whereIn('id', $this->selectedRows)->delete();
        $this->selectedRows = [];
        $this->selectAll = false;

        $this->refreshData();

        session()->flash('message', 'Data Deleted Successfully 🛑');
    }


    public function editRow($id)
    {
        $this->editId = $id;
        $item = Cstdashboard::find($id);

        if ($item) {
            $this->formData = $item->toArray();
            $this->isEditing = true;
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
        // $this->validate([
        //     'formData.date_ctc' => 'required|date',
        //     'formData.ctc_code' => 'required',
        //     'formData.first_name' => 'required',
        //     'formData.last_name' => 'required',
        //     'formData.mail' => 'required|email',
        // ]);

        $item = Cstdashboard::find($this->editId);
        if ($item) {
            $item->update([
                'date_cst' => $this->formData['date_cst'] ?? null,
                'cst_code' => $this->formData['cst_code'] ?? null,
                'civ' => $this->formData['civ'] ?? null,
                'first_name' => $this->formData['first_name'] ?? null,
                'last_name' => $this->formData['last_name'] ?? null,
                'cell' => $this->formData['cell'] ?? null,
                'mail' => $this->formData['mail'] ?? null,
                'status' => $this->formData['status'] ?? null,
                'notes' => $this->formData['notes'] ?? null,
            ]);

            $this->isEditing = false;
            $this->editId = null;
            $this->formData = [];

            $this->refreshData();

            session()->flash('message', 'Form Updated Successfully ✅');
        }
    }




    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        $data = Cstdashboard::orderBy($this->sortField, $this->sortDirection)
            ->paginate(100);

        if ($this->isEditing) {
            return view('livewire.back.cstform.edit');
        }

        return view('livewire.back.cstdashboard.admin', [
            'data' => $data
        ]);
    }
}
