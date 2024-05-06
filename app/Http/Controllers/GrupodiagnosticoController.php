<?php

namespace App\Http\Controllers;

use App\Models\grupodiagnostico;
use Illuminate\Http\Request;

class GrupodiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datatable = grupodiagnostico::all();
        return view('auditorias.index', compact('datatable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auditorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(grupodiagnostico::$rules);
        $request['user_id'] = auth()->user()->id;
        $grupodiagnostico = grupodiagnostico::create($request->all());
        return redirect()->route('auditorias.index')->with('icon','success')->with('title','Exito')->with('success', 'Grupo Diagnostico creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(grupodiagnostico $grupodiagnostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diagnostico = grupodiagnostico::findOrFail($id);

        return view('auditorias.edit', compact('diagnostico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate(grupodiagnostico::$rules);
        $grupodiagnostico = grupodiagnostico::findOrFail($id);
        $grupodiagnostico->update($request->all());
        return redirect()->route('auditorias.index')->with('icon','success')->with('title','Exito')->with('success', 'Grupo Diagnostico actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $grupodiagnostico = grupodiagnostico::findOrFail($id);
            $grupodiagnostico->delete();
            return response()->json(['success' => 'Grupo / Diagnostico eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el Grupo / Diagnostico.'], 500);
        }
    }
}
