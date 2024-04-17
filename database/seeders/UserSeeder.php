<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@local.com',
            'password' => Hash::make('admin@2024'),
            'uuid' => Str::uuid(),
            'trigramme' => strtoupper(preg_replace('/[^A-Za-z]/', '', str_pad(Str::random(3), 3, 'A'))),

        ]);
        $admin->assignRole(Role::where('name', 'Administrateur')->first()->id);
      $consultant = User::create([
            'first_name' => 'Consultant',
            'last_name' => 'Consultant',
            'email' => 'consultant@local.com',
            'password' => Hash::make('consultant@2024'),
            'uuid' => Str::uuid(),
            'trigramme' => strtoupper(preg_replace('/[^A-Za-z]/', '', str_pad(Str::random(3), 3, 'C'))),

        ]);
        $consultant->assignRole(Role::where('name', 'Consultant')->first()->id);
    }
}
