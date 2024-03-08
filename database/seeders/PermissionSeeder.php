<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Tableau de bord',
            'Liste des utilisateurs',
            'Ajouter un utilisateur',
            'Modifier un utilisateur',
            'Supprimer un utilisateur',
            'Liste des rôles',
            'Ajouter un rôle',
            'Modifier un rôle',
            'Supprimer un rôle',
            'Liste des permissions',
            
        ];
        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
