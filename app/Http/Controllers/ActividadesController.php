<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\proyectos;
use App\Models\vs_estados;
use App\Models\vs_prioridades;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $request->validate(actividades::$rules);
        actividades::create($request->all());
        $totalActividades = actividades::where('proyecto_id', $request->proyecto_id);
        $promedio = round($totalActividades->avg('avance'));
        proyectos::where('id', $request->proyecto_id)->update(['avance' => $promedio]);

        
        $proyecto = proyectos::find($request->proyecto_id);
        if ($proyecto->avance > 0) {
            proyectos::where('id', $request->proyecto_id)->update(['estado' =>'22']);
        }elseif ($proyecto->avance == 100){
            proyectos::where('id', $request->proyecto_id)->update(['estado' =>'23']);
        }

        return redirect()->route('proyectos.index')
            ->with('success', 'Actividad creada correctamente.')->with('icon', 'success')->with('title', '¡Éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prioridades = vs_prioridades::pluck('nombre', 'id');
        $estados = vs_estados::pluck('nombre', 'id');
        $proyecto = proyectos::find($id);
        return view('actividades.create', compact('proyecto', 'estados', 'prioridades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(actividades $actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, actividades $actividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(actividades $actividades)
    {
        //
    }
}
