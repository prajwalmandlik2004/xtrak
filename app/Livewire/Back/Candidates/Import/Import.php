<?php

namespace App\Livewire\Back\Candidates\Import;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\CandidatesImport;
use App\Jobs\ImportCandidatesJob;
use App\Models\ImportLog;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class Import extends Component
{
    use WithFileUploads;
    public $file;
    public $fileData;

    public function storeFileData()
    {
        $validateData = $this->validate(
            [
                'file' => 'required|mimes:xls,xlsx|max:10240',
            ],
            [
                'file.required' => 'Le fichier est obligatoire',
                'file.mimes' => 'Le fichier doit être un fichier excel',
            ],
        );

        $path = Storage::putFile('/public/files', $validateData['file']);
        $filepath = Storage::path($path);
        if (file_exists($filepath)) {
            try {
                $user = Auth::user();
                ImportCandidatesJob::dispatch($filepath, $user->id);
                $result = ImportLog::where('file_path', $filepath)
                    ->where('user_id', $user->id)
                    ->first();
                if ($result) {
                    $accepted = json_decode($result->accepted, true);
                    $rejected = json_decode($result->rejected, true);
                    $this->dispatch('data-from-import', accepted: $accepted, rejected: $rejected);
                }
                $this->dispatch('alert', type: 'success', message: 'Opération reusie avec succès');
            } catch (\Exception $e) {
                $this->dispatch('alert', type: 'error', message: 'Une erreure est survenu, merci de réessayez');
            }
        } else {
            $this->dispatch('alert', type: 'error', message: 'Le fichier n\'existe pas');
        }

        $this->reset(['file']);
    }
    public function downloadFile()
    {
        $filePath = public_path('storage/files/caneva.xlsx');

        if (file_exists($filePath)) {
            return response()->download($filePath, 'caneva.xlsx');
        } else {
            $this->dispatch('alert', type: 'error', message: 'Le fichier n\'existe pas');
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.import.import');
    }
}
