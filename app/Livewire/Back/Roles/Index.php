<?php

namespace App\Livewire\Back\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name;
    public $isUpdate = false;
    public $nbPaginate = 10;
    protected $listeners = [
        'delete' => 'destroyData',
    ];

    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le rôle $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function destroyData($id)
    {
        DB::beginTransaction();
        $role = Role::find($id);
        try {
            $role->permissions()->detach();
            $role->delete();
            DB::commit();
            $this->dispatch('alert', type: 'success', message: 'Rôle supprimé avec succès');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer $role->name");
        }
    }
    public function render()
    {
        return view('livewire.back.roles.index', [
            'roles' => Role::where('name', 'like', '%' . $this->search . '%')->paginate($this->nbPaginate),
        ]);
    }
}
