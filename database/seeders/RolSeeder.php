<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        $admin->syncPermissions(['administrador']);
    }
}
