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
    public $newFile = [];
    public $isUpdate = false;
    public $file;
    public $fileType;
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
            $this->fileType = $this->file->file_type ?? '';
        }
    }
    public function storeFile()
    {
        $validateData = $this->validate(
            [
                'name' => 'nullable|string|max:255',
                'newFile' => 'nullable|mimes:pdf,doc,docx|max:2024',
                'fileType' => 'required|string',
            ],
            [
                'newFile.mimes' => 'Le fichier doit être de type: pdf, doc, docx',
                'newFile.max' => 'Le fichier ne doit pas dépasser 2Mo',
                'fileType.required' => 'Le type de fichier est obligatoire',
            ],
        );
        $fileRepository = new FileRepository();
        try {
            DB::beginTransaction();

            if ($this->isUpdate) {
                $fileRepository->update($this->file, ['name' => $validateData['name'], 'file_type' => $validateData['fileType']]);
            } else {
                if ($this->candidate->files()->exists()) {
                    $cvFile = $this->candidate->files()->where('file_type', 'cv')->first();
                    if (!$cvFile) {
                        $certificate = Str::random(10);
                        $this->candidate->update([
                            'certificate' => $certificate,
                            'state' => 'Certifié',
                        ]);
                    }
                }
                $fileRepository->createOne($validateData['newFile'], $this->candidate->id, $validateData['fileType']);
            }
            DB::commit();
            $this->reset('name', 'newFile');
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
