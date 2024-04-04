<?php

namespace App\Livewire\Back\Candidates;

use Livewire\Component;

class Cv extends Component
{
    public $candidate;
    public $cvFile;
    public $filePath;

    public function mount()
    {
        $this->cvFile = $this->candidate->files()->exists() ? $this->candidate->files()->where('file_type', 'cv')->first() : null;
        if ($this->cvFile) {
            $this->filePath = asset('storage/' . $this->cvFile->path);
        }
    }
    public function downloadFile($path, $name)
    {
        $filePath = public_path('storage/' . $path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $name);
        } else {
            $this->dispatch('alert', type: 'error', message: 'Le fichier n\'existe pas');
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.cv');
    }
}
