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
        
        $nombreDiagnostico = $request->get('nombreDiagnostico');
        $descripcionDiagnostico = $request->get('descripcionDiagnostico');
        return response()->json([
            'data' => $data,
            'status' => 'diagnosticoGuardado',
            'nombreDiagnostico' => $nombreDiagnostico,
            'descripcionDiagnostico' => $descripcionDiagnostico
        ]);

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
    public function edit(diagnostico $diagnostico)
    {
        //
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
