<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\proyectos;
use App\Models\vs_estados;
use App\Models\vs_areas;
use App\Models\vs_prioridades;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $datatable = proyectos::where('user_id',auth()->id())->get();

        return view('proyectos.index', compact('datatable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prioridades = vs_prioridades::pluck('nombre', 'id');
        $estados = vs_estados::pluck('nombre', 'id');
        $areas = vs_areas::pluck('nombre', 'id');

        return view('proyectos.create', compact('estados', 'areas', 'prioridades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        request()->validate(proyectos::$rules);
        $proyecto = new proyectos();
        $proyecto->user_id = auth()->id();
        $proyecto->fill($request->all());
        $proyecto->save();


        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.')
            ->with('icon', 'success')->with('title', '¡Éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(proyectos $proyectos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyecto = proyectos::findOrFail($id);
        $prioridades = vs_prioridades::pluck('nombre', 'id');
        $estados = vs_estados::pluck('nombre', 'id');
        $areas = vs_areas::pluck('nombre', 'id');

        return view('proyectos.edit', compact('proyecto', 'estados', 'areas', 'prioridades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate(proyectos::$rules);
        $proyecto = proyectos::findOrFail($id);
        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.')
            ->with('icon', 'success')->with('title', '¡Éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $proyecto = proyectos::findOrFail($id);
            actividades::where('proyecto_id', $id)->delete();
            $proyecto->delete();
            return response()->json(['success' => 'Proyecto eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el proyecto.'], 500);
        }
    }


    public function actividades($id)
    {
        $actividades = actividades::where('proyecto_id', $id)->with('prioridades')->get();
        return response()->json($actividades);
    }

}
