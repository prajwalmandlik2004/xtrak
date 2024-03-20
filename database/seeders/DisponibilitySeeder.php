<?php

namespace Database\Seeders;

use App\Models\Disponibility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisponibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disponibilities = [
            'Disponible',
            'Pas disponible',
            'Intéressé',
            'Pas intéressé',
            'Préavis en cours',
            'Préavis 1 mois',
            'Préavis 2 mois',
            'Préavis 3 mois',
            'A l\'écoute',
            'Pas à l\'écoute',
            'Plusieurs pistes',
            'Silence radio',
            'HIRED'
        ];
        
        foreach ($disponibilities as $disponibility) {
            Disponibility::create([
                'name' => $disponibility,
            ]);
        }
    }
}
