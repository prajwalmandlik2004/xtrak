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
            'Gestion des utilisateurs',
            'Liste des utilisateurs',
            'Ajouter un utilisateur',
            'Modifier un utilisateur',
            'Supprimer un utilisateur',
            'Liste des rôles',
            'Ajouter un rôle',
            'Modifier un rôle',
            'Supprimer un rôle',
            'Liste des permissions',
            'Ajouter une permission',
            'Modifier une permission',
            'Supprimer une permission',
            'Gestion des candidats',
            'Liste des candidats',
            'Ajouter un candidat',
            'Modifier un candidat',
            'Voir un candidat',
            'Supprimer un candidat',
            'Importer des candidats',
            'Menu paramètres',
            'Gestion des rôles et permissions',
            
        ];
        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
