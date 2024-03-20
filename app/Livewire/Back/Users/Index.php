<?php

namespace App\Livewire\Back\Users;

use App\Models\User;
use Livewire\Component;
use App\Mail\GeneralMail;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user;
    public $search = '';
    public $nbPaginate = 10;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $isUpdate = false;
    public $roles;
    public $role_id;
    public $filterRoleId;
    #[On('delete')]
    public function deleteData($id)
    {
        DB::beginTransaction();
        $user = User::find($id);
        try {
            if ($user) {
                $user->delete($user->id);
                DB::commit();
                $this->dispatch('alert', type: 'success', message: 'l\' utilisateur est supprimé avec succès');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer l'utilisateur $user->first_name car il à des données dans la base");
        }
    }

    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer l'utilisateur $nom", type: 'warning', method: 'delete', id: $id);
    }
    public function searchFiles()
    {
        return User::where('first_name', 'like', '%' . $this->search . '%')
            ->when($this->filterRoleId, function ($query) {
                $roleName = Role::where('id', $this->filterRoleId)->first()->name;
                return $query->role($roleName);
            })
            ->paginate($this->nbPaginate);
    }
    public function openModal($id = null)
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->role_id = '';
        $this->isUpdate = false;
        $this->phone = '';
        $this->email = '';
        if ($id) {
            $this->isUpdate = true;
            $this->user = User::find($id);
            $this->first_name = $this->user->first_name ?? '';
            $this->last_name = $this->user->last_name ?? '';
            $this->phone = $this->user->phone ?? '';
            $this->email = $this->user->email ?? '';
            $this->role_id = $this->user->roles->pluck('id')->first() ?? null;
        }
    }
    public function storeData()
    {
        $validateData = $this->validate(
            [
                'first_name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:255',
                'email' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'role_id' => 'nullable',
            ],
            [
                'first_name.required' => 'Le nom est obligatoire',
                'last_name.required' => 'Le prénom est obligatoire',
            ],
        );

        DB::beginTransaction();
        $validateData['uuid'] = Str::uuid();

        if ($this->isUpdate) {
            $this->user->update($validateData);
            $roleId = Role::where('id', $validateData['role_id'])->first()->id;
            $this->user->syncRoles($roleId);
        } else {
            $password = Str::random(8);
            $validateData['password'] = Hash::make($password);
            $user = User::create($validateData);
            $roleId = Role::where('id', $validateData['role_id'])->first()->id;
            $user->assignRole($roleId);
            try {
                Mail::to($user->email)->send(new GeneralMail($user, $password));
            } catch (\Throwable $th) {
                DB::commit();
                $this->dispatch('close:modal');
                $this->dispatch('alert', type: 'success', message: $this->isUpdate ? 'le nom est modifié avec success ' : 'l\'utilisateur est ajouté avec succès mais ses identifiants n\'ont pas été envoyé à son adresse email');
            }
        }
        DB::commit();
        $this->dispatch('close:modal');
        $this->dispatch('alert', type: 'success', message: $this->isUpdate ? 'le nom est modifié avec success' : 'l\'utilisateur est ajouté avec succès');
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: $this->isUpdate ? 'Impossible de modifier le nom' : 'Impossible d\'ajouter l\'utilisateur');
        }
    }
    public function mount()
    {
        $this->roles = Role::all();
    }
    public function render()
    {
        return view('livewire.back.users.index')->with([
            'users' => $this->searchFiles(),
        ]);
    }
}
