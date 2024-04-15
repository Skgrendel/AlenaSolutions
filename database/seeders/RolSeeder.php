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

        $cliente = Role::create([
            'name' => 'Cliente',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        $cliente->syncPermissions(['cliente']);

        $empleado = Role::create([
            'name' => 'Empleado',
            'guard_name' => 'web',
            'estado' => 1,
        ]);
        $cliente->syncPermissions(['empleado']);
    }
}
