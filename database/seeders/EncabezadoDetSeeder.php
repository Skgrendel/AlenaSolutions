<?php

namespace Database\Seeders;

use App\Models\encabezados_det;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncabezadoDetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detalles = [
            [
                'encabezado_id' => '1',
                'nombre' => 'Pendiente',
                'nomenclatura' => 'PE',
            ],
            [
                'encabezado_id' => '1',
                'nombre' => 'En Curso',
                'nomenclatura' => 'EC',
            ],
            [
                'encabezado_id' => '1',
                'nombre' => 'Finalizado',
                'nomenclatura' => 'FI',
            ],
            [
                'encabezado_id' => '2',
                'nombre' => 'Finalizado',
                'nomenclatura' => 'FN',
            ],
            [
                'encabezado_id' => '2',
                'nombre' => 'Baja',
                'nomenclatura' => 'BA',
            ],
            [
                'encabezado_id' => '2',
                'nombre' => 'Media',
                'nomenclatura' => 'ME',
            ],
            [
                'encabezado_id' => '2',
                'nombre' => 'Alta',
                'nomenclatura' => 'AL',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Debida Diligencia',
                'nomenclatura' => 'DD',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Juridica',
                'nomenclatura' => 'RH',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Operaciones',
                'nomenclatura' => 'CO',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Analisis de datos',
                'nomenclatura' => 'DA',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Financiera',
                'nomenclatura' => 'FI',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Recursos Humanos',
                'nomenclatura' => 'RH',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Comercial',
                'nomenclatura' => 'CM',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Sistema integrado de gestion',
                'nomenclatura' => 'SG',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Teconologia de la informacion',
                'nomenclatura' => 'IT',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Contable',
                'nomenclatura' => 'AC',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Administrativa',
                'nomenclatura' => 'AD',
            ],
            [
                'encabezado_id' => '3',
                'nombre' => 'Consultores',
                'nomenclatura' => 'TI',
            ],



        ];

        foreach ($detalles as $detalle) {
            encabezados_det::create($detalle);
        }
    }
}
