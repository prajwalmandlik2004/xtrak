<?php

namespace App\Livewire\Back\Cstform;

use Livewire\Component;
use App\Models\Cstdashboard;

class Index extends Component
{
    public $date_cst;
    public $cst_code;
    public $civ;
    public $first_name;
    public $last_name;
    public $cell;
    public $mail;
    public $status;
    public $notes;
    public $editId;
    public $isEditing = false;

    public $entries;

    // protected $rules = [
    //     'date_ctc' => 'required|date',
    //     'ctc_code' => 'required|string|max:255',
    //     'first_name' => 'required|string|max:255',
    //     'last_name' => 'required|string|max:255',
    // ];

    public function mount()
    {
        $this->loadEntries();
        $this->date_cst = date('Y-m-d');
    }

    public function loadEntries()
    {
        $this->entries = Cstdashboard::all();
    }

    public function save()
    {
        // $this->validate();

        if ($this->isEditing) {
            $entry = Cstdashboard::find($this->editId);
            if ($entry) {
                $entry->update([
                    'date_cst' => $this->date_cst,
                    'cst_code' => $this->cst_code,
                    'civ' => $this->civ,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'cell' => $this->cell,
                    'mail' => $this->mail,
                    'status' => $this->status,
                    'notes' => $this->notes,
                ]);

                session()->flash('message', 'Record updated successfully!');
            }
        } else {
            Cstdashboard::create([
                'date_cst' => $this->date_cst,
                'cst_code' => $this->cst_code,
                'civ' => $this->civ,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'cell' => $this->cell,
                'mail' => $this->mail,
                'status' => $this->status,
                'notes' => $this->notes,
            ]);

            session()->flash('message', 'Form Submitted Successfully ✅');
        }

        $this->resetForm();
        $this->loadEntries();
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->editId = $id;

        $entry = Cstdashboard::find($id);

        if ($entry) {
            $this->date_cst = $entry->date_cst;
            $this->cst_code = $entry->cst_code;
            $this->civ = $entry->civ;
            $this->first_name = $entry->first_name;
            $this->last_name = $entry->last_name;
            $this->cell = $entry->cell;
            $this->mail = $entry->mail;
            $this->status = $entry->status;
            $this->notes = $entry->notes;
        }
    }

    public function resetForm()
    {
        $this->reset([
            'date_cst',
            'cst_code',
            'civ',
            'first_name',
            'last_name',
            'cell',
            'mail',
            'status',
            'notes',
        ]);

        $this->isEditing = false;
        $this->editId = null;
        $this->date_cst = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.back.cstform.index');
    }
}
