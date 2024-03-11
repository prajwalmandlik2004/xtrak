<?php

namespace App\Livewire\Back\Files;

use App\Models\File;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepository;
use Livewire\WithFileUploads;

class CandidateFile extends Component
{
    use WithFileUploads;
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
            $fileRepository->delete($file->id);
            DB::commit();
            $this->dispatch('alert', type: 'success', message: 'le document est supprimé avec succès');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer le document $file->name");
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'delete', id: $id);
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
    public function storeData()
    {
        $validateData = $this->validate([
            'name' => 'nullable|string|max:255',
            'newFiles' => 'nullable',
            'newFiles.*' => 'nullable|mimes:pdf,doc,docx|max:1024',
        ]);
        $fileRepository = new FileRepository();
        DB::beginTransaction();
        
            if ($this->isUpdate) {
                $fileRepository->update($this->file, ['name' => $validateData['name']]);
            } else {
                $fileRepository->create($validateData['newFiles'], $this->candidate->id);
            }
            DB::commit();
            $this->dispatch('close:modal');
            $this->dispatch('alert', type: 'success', message: $this->isUpdate ? 'le nom est modifié avec success' : 'le document est ajouté avec succès');
            try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->isUpdate ? 'Impossible de modifier le nom' : 'Impossible d\'ajouter le document');
        }
    }
    public function render()
    {
        return view('livewire.back.files.candidate-file')->with([
            'files' => $this->searchFiles(),
        ]);
    }
}
