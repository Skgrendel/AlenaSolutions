<?php

namespace Database\Seeders;

use App\Models\preguntas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas = [
            'pregunta' => '¿La empresa cuenta con un documento de Ámbito de aplicación del Régimen de Autocontrol y Gestión del Riesgo LA/FT/FPADM, el cual defina el por qué se encuentra obligada y en qué subnumeral del numeral 4 le aplica?',
            'grupo' => '1',

        ];

        foreach ($preguntas as $pregunta) {
            preguntas::create($pregunta);
        }
    }
}
