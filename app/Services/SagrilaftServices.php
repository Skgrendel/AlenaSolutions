<?php

namespace App\Services;

use App\Models\actividades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SagrilaftServices
{
    public function SistemaSagrilaft($id)
    {


        $encabezados = [
            ['nombre' => 'ÁMBITO DE APLICACIÓN DEL RÉGIMEN DE AUTOCONTROL Y GESTIÓN DEL RIESGO INTEGRAL LA/FT/FPADM.'],
            ['nombre' => 'DISEÑO Y APROBACIÓN'],
            ['nombre' => 'AUDITORIA Y CUMPLIMIENTO DEL SAGRILAFT'],
            ['nombre' => 'DIVULGACIÓN Y CAPACITACIÓN'],
            ['nombre' => 'ASIGNACIÓN DE FUNCIONES A LOS RESPONSABLES Y OTRAS GENERALIDADES'],
            ['nombre' => 'IDENTIFICACION DEL RIESGO LA/FT/FPDAM'],
            ['nombre' => 'MEDICIÓN O EVALUACIÓN DEL RIESGO LA/FT/FPADM'],
            ['nombre' => 'CONTROL DEL RIESGO'],
            ['nombre' => 'MONITOREO DEL RIESGO'],
            ['nombre' => 'PROCEDIMIENTOS DE DEBIDA DILIGENCIA Y DEBEDIDA DILIGENCIA INTENSIFICADA'],
            ['nombre' => 'SEÑALES DE ALERTA'],
            ['nombre' => 'DOCUMENTACION DE LAS ACTIVIDADES DEL SAGRILAFT'],
            ['nombre' => 'REPORTES DE OPERACIONES SOSPECHOSAS Y OTROS REPORTES A LA UIAF'],
        ];

        $user = Auth::user();

        if (!$user || !$user->personal) {
            Log::error("User or personal information is missing.");
            return;
        }

        foreach ($encabezados as $encabezado) {
            try {
                actividades::create([
                    'proyecto_id' => $id,
                    'nombre' => $encabezado['nombre'],
                    'prioridad' => 7,
                    'personal_asignado' => $user->personal->nombres,
                    'descripcion' => $encabezado['nombre'],
                    'avance' => 0,
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to create actividad: " . $e->getMessage());
            }
        }

        Log::info("SistemaSagrilaft method executed for project ID: $id");
    }
}
