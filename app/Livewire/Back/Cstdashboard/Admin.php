<?php

namespace App\Livewire\Back\Cstdashboard;

use App\Models\Cstdashboard;
use Livewire\Component;
use Livewire\WithPagination;

// OPP Link 
use App\Models\Oppdashboard;
use App\Models\CstOppLink;

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


    // OPP Link 
    public $oppCode = '';
    public $showOppModal = false;
    public $oppLinkError = '';

    // Rules for OPP code validation
    protected $rules_opp = [
        'oppCode' => 'required',
    ];


    public $showCheckboxes = false;

    public function toggleSelectionMode()
    {
        $this->showCheckboxes = !$this->showCheckboxes;
        if (!$this->showCheckboxes) {
            $this->selectedRows = [];
            $this->selectAll = false;
        }
    }


    public function refreshData()
    {
        $this->datas = Cstdashboard::latest()->get();
    }

    public function updatedSelectAll($value)
    {
        // if ($value) {
        //     $this->selectedRows = $this->data->pluck('id')->map(function ($id) {
        //         return (string) $id;
        //     })->toArray();
        // } else {
        //     $this->selectedRows = [];
        // }


        if (!empty($this->selectedRows)) {
            $linkedDataCount = CstOppLink::whereIn('cst_id', $this->selectedRows)->count();

            if ($linkedDataCount === 0) {
                $this->dispatch('hide-opplist-button');
            } else {
                $this->dispatch('enable-opplist-button');
            }
        } else {
            $this->dispatch('disable-opplist-button');
        }
    }

    public function toggleSelect($id)
    {
        if (in_array($id, $this->selectedRows)) {
            $this->selectedRows = array_diff($this->selectedRows, [$id]);
        } else {
            $this->selectedRows = [$id];
        }

        if (!empty($this->selectedRows)) {
            $linkedDataCount = CstOppLink::whereIn('cst_id', $this->selectedRows)->count();

            if ($linkedDataCount === 0) {
                $this->dispatch('hide-opplist-button');
            } else {
                $this->dispatch('enable-opplist-button');
            }
        } else {
            $this->dispatch('disable-opplist-button');
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

        $this->dispatch('alert', type: 'success', message: "Data Deleted Successfully");
    }



    public function checkLinkedData()
    {
        if (empty($this->selectedRows)) {
            return false;
        }

        $linkedDataCount = CstOppLink::whereIn('cst_id', $this->selectedRows)->count();
        return $linkedDataCount > 0;
    }

    public function showLinkedData()
    {
        if (empty($this->selectedRows)) {
            // session()->flash('message', 'Please select a row to view linked data.');
            redirect()->route('cstopplist');
            return;
        }

        $linkedDataCount = CstOppLink::whereIn('cst_id', $this->selectedRows)->count();

        if ($linkedDataCount === 0) {
            // session()->flash('message', 'No linked data for selected row.');
            $this->dispatch('alert', type: 'error', message: "No data linked to the selected row.");
            $this->dispatch('hide-opplist-button');
            return;
        }

        redirect()->route('cstopplist', ['selectedRows' => $this->selectedRows]);
    }


    // New methods for OPP linking
    public function openOppModal()
    {
        if (empty($this->selectedRows)) {
            // session()->flash('error', 'Please select at least one opportunity to link');
            $this->dispatch('alert', type: 'error', message: "Please select at least one CST to link");

            return;
        }

        $this->showOppModal = true;
        $this->oppCode = '';
        $this->oppLinkError = '';
        $this->dispatch('open-opp-modal');
    }

    public function closeOppModal()
    {
        $this->showOppModal = false;
        $this->oppCode = '';
        $this->oppLinkError = '';

        $this->dispatch('closeModal', modalId: 'oppLinkModal');
    }

    public function linkOpp()
    {
        $this->validate([
            'oppCode' => 'required',
        ]);

        // Check if any rows are selected
        if (empty($this->selectedRows)) {
            // $this->cstLinkError = 'Please select at least one opportunity to link';
            $this->dispatch('alert', type: 'error', message: "Please select at least one CST to link");
            return;
        }

        // Find the candidate with the given code
        $candidate = Oppdashboard::where('opp_code', $this->oppCode)->first();

        if (!$candidate) {
            // $this->cstLinkError = 'No data found with this CST code';
            $this->dispatch('alert', type: 'error', message: "No data found with this OPP code");
            $this->oppCode = '';
            $this->closeOppModal();
            $this->dispatch('closeModal', modalId: 'oppLinkModal');
            return;
        }

        $linkedCount = 0;
        $alreadyLinkedCount = 0;

        // Link each selected opportunity to the CDT
        foreach ($this->selectedRows as $trgId) {
            // Check if already linked
            $existingLink = CstOppLink::where('cst_id', $trgId)
                ->where('opp_id', $candidate->id)
                ->first();

            if ($existingLink) {
                $alreadyLinkedCount++;
                continue;
            }

            // Create new link
            CstOppLink::create([
                'cst_id' => $trgId,
                'opp_id' => $candidate->id
            ]);

            $linkedCount++;
        }

        // Show appropriate message
        if ($linkedCount > 0 && $alreadyLinkedCount > 0) {
            // session()->flash('linkmessage', "$linkedCount opportunities linked successfully $alreadyLinkedCount were already linked.");
            $this->dispatch('alert', type: 'success', message: "$linkedCount CSTs linked successfully $alreadyLinkedCount were already linked.");
            $this->oppCode = '';
            $this->closeOppModal();
            $this->dispatch('closeModal', modalId: 'oppLinkModal');
        } elseif ($linkedCount > 0) {
            // session()->flash('linkmessage', "$linkedCount opportunities linked successfully");
            $this->dispatch('alert', type: 'success', message: "$linkedCount CSTs linked successfully");
            $this->oppCode = '';
            $this->closeOppModal();
            $this->dispatch('closeModal', modalId: 'oppLinkModal');
        } elseif ($alreadyLinkedCount > 0) {
            // $this->cstLinkError = "Selected opportunities are already linked to this CST";
            $this->dispatch('alert', type: 'error', message: "Selected CSTs are already linked to this OPP");
            $this->oppCode = '';
            $this->closeOppModal();
            $this->dispatch('closeModal', modalId: 'oppLinkModal');

            return;
        }

        // Clear inputs and close modal
        $this->oppCode = '';
        $this->closeOppModal();
        $this->dispatch('closeModal', modalId: 'oppLinkModal');
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
