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
        $disponibilities =  [
            '1' => 'Immédiatement',
            '2' => '1 mois',
            '3' => '2 mois',
            '4' => '3 mois',
            '5' => '4 mois',
            '6' => '5 mois',
            '7' => '6 mois',
            '8' => '7 mois',
            '9' => '8 mois',
            '10' => '9 mois',
            '11' => '10 mois',
            '12' => '11 mois',
            '13' => '12 mois',
            '14' => '1 semaine',
            '15' => '2 semaines',
            '16' => '3 semaines',
            '17' => '4 semaines',
            '18' => '1 jour',
            '19' => '2 jours',
            '20' => '3 jours',
            '21' => '4 jours',
            '22' => '5 jours',
            '23' => '6 jours',
            '24' => '7 jours',
            '25' => '8 jours',
            '26' => '9 jours',
            '27' => '10 jours',
            '28' => '11 jours',
            '29' => '12 jours',
            '30' => '13 jours',
            '31' => '14 jours',
            '32' => '15 jours',
            '33' => '16 jours',
            '34' => '17 jours',
            '35' => '18 jours',
            '36' => '19 jours',
            '37' => '20 jours',
            '38' => '21 jours',
            '39' => '22 jours',
            '40' => '23 jours',
            '41' => '24 jours',
            '42' => '25 jours',
            '43' => '26 jours',
            '44' => '27 jours',
            '45' => '28 jours',
            '46' => '29 jours',
            '47' => '30 jours',
            '48' => '31 jours',
        ];
        foreach ($disponibilities as $disponibility) {
            Disponibility::create([
                'name' => $disponibility,
            ]);
        }
    }
}
