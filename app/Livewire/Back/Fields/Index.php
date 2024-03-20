<?php

namespace App\Livewire\Back\Fields;

use App\Models\Field;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $field;
    public $search = '';
    public $nbPaginate = 10;
    public $name;
    public $isUpdate = false;
    #[On('delete')]
    public function deleteData($id)
    {
        DB::beginTransaction();
        $field = Field::find($id);
        try {
            if ($field) {
                $field->delete($field->id);
                DB::commit();
                $this->dispatch('alert', type: 'success', message: 'le domaine est supprimé avec succès');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer le domaine $field->name");
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le domaine $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function searchFiles()
    {
        return Field::where('name', 'like', '%' . $this->search . '%')->paginate($this->nbPaginate);
    }
    public function openModal($id = null)
    {
        $this->name = '';
        $this->isUpdate = false;
        if ($id) {
            $this->isUpdate = true;
            $this->field = Field::find($id);
            $this->name = $this->field->name ?? '';
        }
    }
    public function storeData()
    {
        $validateData = $this->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Le nom est obligatoire',
            ],
        );
        try {
        DB::beginTransaction();

        if ($this->isUpdate) {
            $this->field->update($validateData);
        } else {
            Field::create($validateData);
        }
        DB::commit();
        $this->dispatch('close:modal');
        $this->dispatch('alert', type: 'success', message: $this->isUpdate ? 'le nom est modifié avec success' : 'le domaine est ajouté avec succès');
      
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->isUpdate ? 'Impossible de modifier le nom' : 'Impossible d\'ajouter le domaine');
        }
    }
    public function render()
    {
        return view('livewire.back.fields.index')->with([
            'fields' => $this->searchFiles(),
        ]);
    }
}
