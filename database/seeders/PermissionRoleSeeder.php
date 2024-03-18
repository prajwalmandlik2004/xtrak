<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'Administrateur')->first();
        $admin->syncPermissions(Permission::all());
        $admin = Role::where('name', 'Consultant')->first();
        $admin->syncPermissions(Permission::all());
    }
}
