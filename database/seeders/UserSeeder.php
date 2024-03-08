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
    
        $user =  User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@local.com',
            'password' => Hash::make('admin@2024'),
            'uuid' => Str::uuid(),

        ]);
        $user->assignRole(Role::where('name', 'Administrateur')->first()->id);
    }
}
