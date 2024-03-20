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
            'Menu accès BaseCDT',
            'Liste des candidats',
            'Menu synthèse',
            'Menu Détails',
            'Menu activité',
            'Importer des candidats',
            'Ajouter un candidat',
            "Menu etats",
            "Menu saisie",
            'Menu paramètres',
            'Menu utilisateur',
            'Liste des utilisateurs',
            'Gestion des rôles',
            'Gestion des permissions',
            'Menu paramètre BaseCDT',
            'Gestion des sociétes',
            'Gestion des spécialites',
            'Gestion des postes',
            'Gestion des domaines',
            'Gestion des disponibilites',
            'Gestion des civilites',
            "Menu capture / gestion",
            "Gestion des étape suivante"
        ];
        foreach ($permissions as $key => $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
