<?php

namespace Database\Seeders;

use App\Models\encabezados_preguntas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncabezadosPreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $encabezados = [
            [
                'nombre' => 'ÁMBITO DE APLICACIÓN DEL RÉGIMEN DE AUTOCONTROL Y GESTIÓN DEL RIESGO INTEGRAL LA/FT/FPADM.',
            ],
            [
                'nombre' => 'DISEÑO Y APROBACIÓN',
            ],
            [
                'nombre' => 'AUDITORIA Y CUMPLIMIENTO DEL SAGRILAFT',
            ],
            [
                'nombre' => 'DIVULGACIÓN Y CAPACITACIÓN',
            ],
            [
                'nombre' => 'ASIGNACIÓN DE FUNCIONES A LOS RESPONSABLES Y OTRAS GENERALIDADES',
            ],
            [
                'nombre' => 'IDENTIFICACION DEL RIESGO LA/FT/FPDAM',
            ],
            [
                'nombre' => 'MEDICIÓN O EVALUACIÓN DEL RIESGO LA/FT/FPADM',
            ],
            [
                'nombre' => 'CONTROL DEL RIESGO',
            ],
            [
                'nombre' => 'MONITOREO DEL RIESGO',
            ],
            [
                'nombre' => 'PROCEDIMIENTOS DE DEBIDA DILIGENCIA Y DEBEDIDA DILIGENCIA INTENSIFICADA',
            ],
            [
                'nombre' => 'SEÑALES DE ALERTA',
            ],
            [
                'nombre' => 'DOCUMENTACION DE LAS ACTIVIDADES DEL SAGRILAFT',
            ],
            [
                'nombre' => 'REPORTES DE OPERACIONES SOSPECHOSAS Y OTROS REPORTES A LA UIAF',
            ],
        ];

        foreach ($encabezados as $encabezado) {
            encabezados_preguntas::create($encabezado);
        }
    }
}
