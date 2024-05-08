<?php

namespace App\Http\Controllers;

use App\Models\calificaciones;
use App\Models\diagnostico;
use App\Models\encabezados_preguntas;
use App\Models\grupodiagnostico;
use App\Models\preguntas;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        // Prepara los datos para la inserción masiva
        $diagnosticos = [];

        // Cuenta la cantidad de preguntas que se enviaron

        $cantidad = count(array_filter(array_keys($data), function ($key) {
            return strpos($key, 'preguntas_id') === 0;
        }));

        for ($i = 1; $i <= $cantidad; $i++) {
            $diagnosticos[] = [
                'preguntas_id' => $data['preguntas_id' . $i],
                'calificacion_id' => $data['cumplimineto' . $i],
                'observacion' => $data['observaciones' . $i],
            ];
        }
        // Convertir el array a JSON
        $diagnosticosJson = json_encode($diagnosticos);


        // Insertar el JSON en la tabla
        diagnostico::create([
            'nombre' => $data['inputNombreDiagnostico'],
            'objetivo' => $data['inputDescripDiagnostico'],
            'grupodiagnosticos_id' => $data['id_diagnostico'],
            'resultados' => $diagnosticosJson,
        ]);

        return redirect()->route('auditorias.index')->with('title', 'Exito')->with('icon', 'success')->with('success', 'Diagnóstico creado con éxito');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $empresa = grupodiagnostico::findOrFail($id);
        $mods = [];
        for ($i = 1; $i <= 13; $i++) {
            $mods["mod{$i}"] = preguntas::where('grupo', (string)$i)->get();
        }
        $calificaciones = calificaciones::pluck('nombre', 'id');
        $encabezados = encabezados_preguntas::all();
        return view('diagnosticos.create', compact('calificaciones', 'mods', 'encabezados', 'empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, diagnostico $diagnostico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(diagnostico $diagnostico)
    {
        //
    }
}
