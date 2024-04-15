<?php

namespace Database\Seeders;

use App\Models\encabezados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncabezadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $encabezados = [
            [
                'nombre' => 'Areas',
                'nomenclatura' => 'AR',
            ],
            [
                'nombre' => 'Prioridades',
                'nomenclatura' => 'PR',
            ],
            [
                'nombre' => 'Estados',
                'nomenclatura' => 'ES',
            ],
        ];

            foreach ($encabezados as $encabezado) {
                encabezados::create($encabezado);
            }
    }
}
