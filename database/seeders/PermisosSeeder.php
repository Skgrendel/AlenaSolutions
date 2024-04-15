<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Crea un permiso
         Permission::create([
            'name' => 'administrador',
            'guard_name' => 'web',
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);
         Permission::create([
            'name' => 'cliente',
            'guard_name' => 'web',
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);
         Permission::create([
            'name' => 'empleado',
            'guard_name' => 'web',
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);
    }
}
