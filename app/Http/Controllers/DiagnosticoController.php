<?php

namespace App\Http\Controllers;

use App\Models\calificaciones;
use App\Models\diagnostico;
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
        $calificaciones = calificaciones::pluck('nombre', 'id');
        return view('diagnosticos.create', compact('calificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombreDiagnostico = $request->get('nombreDiagnostico');
        $descripcionDiagnostico = $request->get('descripcionDiagnostico');
        return response()->json([
            'status' => 'diagnosticoGuardado',
            'nombreDiagnostico' => $nombreDiagnostico,
            'descripcionDiagnostico' => $descripcionDiagnostico
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(diagnostico $diagnostico)
    {
        //
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
