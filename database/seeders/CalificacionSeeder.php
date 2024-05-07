<?php

namespace Database\Seeders;

use App\Models\calificaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        calificaciones::create([
            'nombre' => 'Cumplido',
            'nomeclatura' => 'C',
            'calificacion' => 4,
        ]);
        calificaciones::create([
            'nombre' => 'Mayoritariamente Cumplido',
            'nomeclatura' => 'MC',
            'calificacion' => 3,
        ]);
        calificaciones::create([
            'nombre' => 'Parcialmente Cumplido',
            'nomeclatura' => 'PC',
            'calificacion' => 2,
        ]);
        calificaciones::create([
            'nombre' => 'No Cumplido',
            'nomeclatura' => 'NC',
            'calificacion' => 1,
        ]);
        calificaciones::create([
            'nombre' => 'No Aplica',
            'nomeclatura' => 'NA',
            'calificacion' => 0,
        ]);
    }
}
