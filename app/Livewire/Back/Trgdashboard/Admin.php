<?php

namespace App\Livewire\Back\Trgdashboard;

use App\Models\Trgdashboard;
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
        $this->datas = Trgdashboard::latest()->get();
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

        Trgdashboard::whereIn('id', $this->selectedRows)->delete();
        $this->selectedRows = [];
        $this->selectAll = false;

        $this->refreshData();

        // session()->flash('message', 'Data Deleted Successfully 🛑');
        $this->dispatch('alert', type: 'success', message: "Data Deleted Successfully");
        
    }


    public function editRow($id)
    {
        $this->editId = $id;
        $item = Trgdashboard::find($id);

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

        $item = Trgdashboard::find($this->editId);
        if ($item) {
            $item->update([
                'creation_date' => $this->formData['creation_date'] ?? null,
                'auth' => $this->formData['auth'] ?? null,
                'company' => $this->formData['company'] ?? null,
                'standard_phone' => $this->formData['standard_phone'] ?? null,
                'website_url' => $this->formData['website_url'] ?? null,
                'trg_code' => $this->formData['trg_code'] ?? null,
                'address' => $this->formData['address'] ?? null,
                'address_one' => $this->formData['address_one'] ?? null,
                'postal_code_department' => $this->formData['postal_code_department'] ?? null,
                'region' => $this->formData['region'] ?? null,
                'town' => $this->formData['town'] ?? null,
                'country' => $this->formData['country'] ?? null,
                'ca_k' => $this->formData['ca_k'] ?? null,
                'employees' => $this->formData['employees'] ?? null,
                'activity' => $this->formData['activity'] ?? null,
                'type' => $this->formData['type'] ?? null,
                'siret' => $this->formData['siret'] ?? null,
                'rcs' => $this->formData['rcs'] ?? null,
                'filiation' => $this->formData['filiation'] ?? null,
                'off' => $this->formData['off'] ?? null,
                'legal_form' => $this->formData['legal_form'] ?? null,
                'vat_number' => $this->formData['vat_number'] ?? null,
                'trg_status' => $this->formData['trg_status'] ?? null,
                'remarks' => $this->formData['remarks'] ?? null,
                'notes' => $this->formData['notes'] ?? null,
                'last_modification_date' => $this->formData['last_modification_date'] ?? null,
                'priority' => $this->formData['priority'] ?? null,

            ]);

            $this->isEditing = false;
            $this->editId = null;
            $this->formData = [];

            $this->refreshData();

            // session()->flash('message', 'Form Updated Successfully ✅');
            $this->dispatch('alert', type: 'success', message: "Form Updated Successfully");
        
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
        $data = Trgdashboard::orderBy($this->sortField, $this->sortDirection)
            ->paginate(100);

        if ($this->isEditing) {
            return view('livewire.back.trgform.edit');
        }

        return view('livewire.back.trgdashboard.admin', [
            'data' => $data
        ]);
    }
}


