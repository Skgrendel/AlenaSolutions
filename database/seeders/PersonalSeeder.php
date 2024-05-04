<?php

namespace Database\Seeders;

use App\Models\personals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Personal de Administrador Predeterminado
         $personal = personals::create([
            'tipo_documento'=>'CC',
            'numero_documento'=>'0000',
            'nombres'=>'Administrador',
            'area'=>'16',
            'apellidos'=>'Sistema',
            'correo'=>'admin@proderi.com',
        ]);
    }
}
