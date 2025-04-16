<?php

namespace App\Livewire\Back\Mcpform;

use Livewire\Component;
use App\Models\Mcpdashboard;
use Illuminate\Support\Str;

class Index extends Component
{
    public $date_mcp;
    public $mcp_code;
    public $designation;
    public $object;
    public $tag_source;
    public $message;
    public $tool;
    public $remarks;
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
        $this->date_mcp = date('Y-m-d');
    }

    public function loadEntries()
    {
        $this->entries = Mcpdashboard::all();
    }

     private function generateMcpCode()
    {
        // Get current date components
        $date = date('ymd', strtotime($this->date_mcp)); // Format: 240416 (for April 16, 2024)
        
        // Get first two characters of designation (if available)
        $desPrefix = $this->designation ? strtoupper(substr($this->designation, 0, 2)) : 'XX';
        
        // Generate a random 2-character string to ensure uniqueness
        $random = strtoupper(Str::random(2));
        
        // Combine elements to create the code (ensuring exactly 8 characters)
        $code = $desPrefix . $date . $random;
        
        // If the code is longer than 8 characters, truncate it
        if (strlen($code) > 8) {
            $code = substr($code, 0, 8);
        }
        // If the code is less than 8 characters, pad it with random characters
        elseif (strlen($code) < 8) {
            $code .= strtoupper(Str::random(8 - strlen($code)));
        }
        
        return $code;
    }


    public function save()
    {
        // $this->validate();

        $this->mcp_code = $this->generateMcpCode();

        if ($this->isEditing) {
            $entry = Mcpdashboard::find($this->editId);
            if ($entry) {
                $entry->update([
                    'date_mcp' => $this->date_mcp,
                    'mcp_code' => $this->mcp_code,
                    'designation' => $this->designation,
                    'object' => $this->object,
                    'tag_source' => $this->tag_source,
                    'message' => $this->message,
                    'tool' => $this->tool,
                    'remarks' => $this->remarks,
                    'notes' => $this->notes,

                ]);

                session()->flash('message', 'Record updated successfully!');
            }
        } else {
            Mcpdashboard::create([
                'date_mcp' => $this->date_mcp,
                'mcp_code' => $this->mcp_code,
                'designation' => $this->designation,
                'object' => $this->object,
                'tag_source' => $this->tag_source,
                'message' => $this->message,
                'tool' => $this->tool,
                'remarks' => $this->remarks,
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

        $entry = Mcpdashboard::find($id);

        if ($entry) {
            $this->date_mcp = $entry->date_mcp;
            $this->mcp_code = $entry->mcp_code;
            $this->designation = $entry->designation;
            $this->object = $entry->object;
            $this->tag_source = $entry->tag_source;
            $this->message = $entry->message;
            $this->tool = $entry->tool;
            $this->remarks = $entry->remarks;
            $this->notes = $entry->notes;
        }
    }

    public function resetForm()
    {
        $this->reset([
            'date_mcp',
            'mcp_code',
            'designation',
            'object',
            'tag_source',
            'message',
            'tool',
            'remarks',
            'notes',
        ]);

        $this->isEditing = false;
        $this->editId = null;
        $this->date_mcp = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.back.mcpform.index');
    }
}
