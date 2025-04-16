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

        // Base code (will be at most 6 characters)
        $baseCode = $desPrefix . substr($date, 0, 4);

        // Generate the remaining characters with randomness to ensure uniqueness
        $randomChars = strtoupper(Str::random(8 - strlen($baseCode)));
        $code = $baseCode . $randomChars;

        // Check if this code already exists in the database
        $codeExists = Mcpdashboard::where('mcp_code', $code)->exists();

        // If code already exists, regenerate until we get a unique one
        $attempts = 0;
        while ($codeExists && $attempts < 10) {
            $randomChars = strtoupper(Str::random(8 - strlen($baseCode)));
            $code = $baseCode . $randomChars;
            $codeExists = Mcpdashboard::where('mcp_code', $code)->exists();
            $attempts++;
        }

        // If we still couldn't generate a unique code after several attempts,
        // create a completely random one as a fallback
        if ($codeExists) {
            $code = strtoupper(Str::random(8));

            // Make sure even the completely random code is unique
            while (Mcpdashboard::where('mcp_code', $code)->exists()) {
                $code = strtoupper(Str::random(8));
            }
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
