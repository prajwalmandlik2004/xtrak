<?php

namespace App\Livewire\Back\Files;

use App\Models\File;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;

class CandidateFile extends Component
{
    use WithFileUploads, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $candidate;
    public $search = '';
    public $nbPaginate = 5;
    public $name;
    public $newFiles = [];
    public $isUpdate = false;
    public $file;
    #[On('delete')]
    public function deleteData($id)
    {
        $fileRepository = new FileRepository();
        DB::beginTransaction();
        $file = $fileRepository->find($id);
        try {
            if ($file) {
                $fileRepository->delete($file->id);
                DB::commit();
                $this->dispatch('alert', type: 'success', message: 'le document est supprimé avec succès');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer le document $file->name");
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le document  $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function searchFiles()
    {
        return $this->candidate
            ->files()
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->nbPaginate);
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->isUpdate = false;
        if ($id) {
            $this->isUpdate = true;
            $this->file = File::find($id);
            $this->name = $this->file->name ?? '';
        }
    }
    public function storeFile()
    {
        $validateData = $this->validate(
            [
                'name' => 'nullable|string|max:255',
                'newFiles' => 'nullable',
                'newFiles.*' => 'nullable|mimes:pdf,doc,docx|max:1024',
            ],
            [
                'newFiles.required' => 'Veuillez choisir un fichier',
                'newFiles.*.mimes' => 'Le fichier doit être de type: pdf, doc, docx',
                'newFiles.*.max' => 'Le fichier ne doit pas dépasser 1 Mo',
            ],
        );
        $fileRepository = new FileRepository();
        try {
            DB::beginTransaction();

            if ($this->isUpdate) {
                $fileRepository->update($this->file, ['name' => $validateData['name']]);
            } else {
                if (!$this->candidate->files()->exists()) {
                    $certificate = Str::random(10);
                    $this->candidate->update([
                        'certificate' => $certificate,
                        'state' => 'Certifié',
                    ]);
                }
                $fileRepository->create($validateData['newFiles'], $this->candidate->id);
            }
            DB::commit();
            $this->reset('name', 'newFiles');
            $this->dispatch('close:modal');
            $this->dispatch('alert', type: 'success', message: $this->isUpdate ? 'le nom est modifié avec success' : 'le document est ajouté avec succès');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->isUpdate ? 'Impossible de modifier le nom' : 'Impossible d\'ajouter le document');
        }
    }
    public function downloadFile($path, $name)
    {
        $filePath = public_path('storage/' . $path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $name);
        } else {
            session()->flash('message', 'Le fichier n\'existe pas.');
        }
    }
    public function render()
    {
        return view('livewire.back.files.candidate-file')->with([
            'files' => $this->searchFiles(),
        ]);
    }
}
