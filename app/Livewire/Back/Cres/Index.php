<?php

namespace App\Livewire\Back\Cres;

use App\Models\Cre;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $candidate;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $cre;
    public $search = '';
    public $nbPaginate = 8;
    public $response;
    public $isUpdate = false;
    #[On('deletecre')]
    public function deleteCre($id)
    {
        DB::beginTransaction();
        $cre = Cre::find($id);
        try {
            if ($cre) {
                $cre->delete($cre->id);
                DB::commit();
                $this->dispatch('alert', type: 'success', message: 'Le C.R.E est supprimé avec succès');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer Le C.R.E $cre->name");
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer la reponse $nom", type: 'warning', method: 'deletecre', id: $id);
    }
    public function searchFiles()
    {
        return $this->candidate
            ->cres()
            ->where('response', 'like', '%' . $this->search . '%')
            ->paginate($this->nbPaginate);
    }
    public function openModal($id = null)
    {
        $this->response = '';
        $this->isUpdate = false;
        if ($id) {
            $this->isUpdate = true;
            $this->cre = Cre::find($id);
            $this->response = $this->cre->name ?? '';
        }
    }
    public function storeData()
    {
        $validateData = $this->validate(
            [
                'response' => 'required|string|max:255',
            ],
            [
                'response.required' => 'La réponse est obligatoire',
            ],
        );
        try {
            DB::beginTransaction();

            if ($this->isUpdate) {
                $this->cre->update($validateData);
            } else {
                Cre::create($validateData);
            }
            DB::commit();
            $this->dispatch('close:modal');
            $this->dispatch('alert', type: 'success', message: $this->isUpdate ? 'la réponse est modifié avec success' : 'Le C.R.E est ajouté avec succès');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->isUpdate ? 'Impossible de modifier la réponse' : 'Impossible d\'ajouter Le C.R.E');
        }
    }
    public function render()
    {
        return view('livewire.back.cres.index')->with([
            'cres' => $this->searchFiles(),
        ]);
    }
}
