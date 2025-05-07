<?php

namespace App\Livewire\Back\Ctcdashboard;

use App\Models\Ctcdashboard;
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
        $this->datas = Ctcdashboard::latest()->get();
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
            $this->selectedRows = [$id];
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            return;
        }

        Ctcdashboard::whereIn('id', $this->selectedRows)->delete();
        $this->selectedRows = [];
        $this->selectAll = false;

        $this->refreshData();

        session()->flash('message', 'Data Deleted Successfully 🛑');
    }


    public function editRow($id)
    {
        $this->editId = $id;
        $item = Ctcdashboard::find($id);

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

        $item = Ctcdashboard::find($this->editId);
        if ($item) {
            $item->update([
                'date_ctc' => $this->formData['date_ctc'],
                'ctc_code' => $this->formData['ctc_code'],
                'trg_code' => $this->formData['trg_code'] ?? null,
                'company_ctc' => $this->formData['company_ctc'] ?? null,
                'civ' => $this->formData['civ'] ?? null,
                'first_name' => $this->formData['first_name'],
                'last_name' => $this->formData['last_name'],
                'function_ctc' => $this->formData['function_ctc'] ?? null,
                'std_ctc' => $this->formData['std_ctc'] ?? null,
                'ext_ctc' => $this->formData['ext_ctc'] ?? null,
                'ld' => $this->formData['ld'] ?? null,
                'remarks' => $this->formData['remarks'] ?? null,
                'cell' => $this->formData['cell'] ?? null,
                'mail' => $this->formData['mail'],
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
        $data = Ctcdashboard::orderBy($this->sortField, $this->sortDirection)
            ->paginate(100);

        if ($this->isEditing) {
            return view('livewire.back.ctcform.edit');
        }

        return view('livewire.back.ctcdashboard.admin', [
            'data' => $data
        ]);
    }
}



