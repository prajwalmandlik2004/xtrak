<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = ['Dessinateur projeteur leader', 'Electromécanicien', 'Technicien industrialisation'];
        foreach ($positions as $position) {
            Position::create(['name' => $position]);
        }

    }
}
