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
        $actividades = actividades::create($request->all());
        $proyecto_id = $request->proyecto_id;
        $totalActividades = actividades::where('proyecto_id', $request->proyecto_id);
        $promedio = round($totalActividades->avg('avance'));
        proyectos::where('id', $request->proyecto_id)->update(['avance' => $promedio]);

        $proyecto = proyectos::find($request->proyecto_id); // Obtiene el proyecto después de actualizar el avance

         // Actualiza el estado del proyecto
        if ($proyecto->avance > 0 && $proyecto->avance < 100) {
            proyectos::where('id', $request->proyecto_id)->update(['estado' => '2']);
            proyectos::where('id', $request->proyecto_id)->update(['prioridad' => '5']);

        } elseif ($proyecto->avance == 100) {
            proyectos::where('id', $request->proyecto_id)->update(['estado' => '3']);
            proyectos::where('id', $request->proyecto_id)->update(['prioridad' => '4']);
        }

          // Actualiza el estado de la actividad
          if ($actividades->avance > 0 && $actividades->avance < 100) {
            actividades::where('id', $actividades->id)->update(['estado' => '2']);
        } elseif ($actividades->avance == 100) {
            actividades::where('id', $actividades->id)->update(['estado' => '3']);
        }


        return redirect()->route('proyectos.actividades',$proyecto_id )
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
    public function edit(string $id)
    {
        $prioridades = vs_prioridades::pluck('nombre', 'id');
        $estados = vs_estados::pluck('nombre', 'id');
        $actividades = actividades::find($id);
        $proyecto = proyectos::find($actividades->proyecto_id);
        return view('actividades.edit', compact('actividades', 'estados', 'prioridades', 'proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(actividades::$rules);
        $actividades = actividades::find($id);
        $proyecto_id = $actividades->proyecto_id;
        $actividades->update($request->all());


        $totalActividades = actividades::where('proyecto_id', $proyecto_id);
        $promedio = round($totalActividades->avg('avance'));
        proyectos::where('id', $proyecto_id)->update(['avance' => $promedio]);

        $proyecto = proyectos::find($proyecto_id); // Obtiene el proyecto después de actualizar el avance

        if ($proyecto->avance > 0 && $proyecto->avance < 100) {
            proyectos::where('id', $proyecto_id)->update(['estado' => '2']);
            proyectos::where('id', $proyecto_id)->update(['prioridad' => '5']);
        } elseif ($proyecto->avance == 100) {
            proyectos::where('id', $proyecto_id)->update(['estado' => '3']);
            proyectos::where('id', $proyecto_id)->update(['prioridad' => '4']);
        }

        // Actualiza el estado de la actividad
        if ($actividades->avance > 0 && $actividades->avance < 100) {
            actividades::where('id', $id)->update(['estado' => '2']);

        } elseif ($actividades->avance == 100) {
            actividades::where('id', $id)->update(['estado' => '3']);
        }

        return redirect()->route('proyectos.actividades',$proyecto_id )
            ->with('success', 'Actividad actualizada correctamente.')->with('icon', 'success')->with('title', '¡Éxito!');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $actividades = actividades::findOrFail($id);
            $proyecto_id = $actividades->proyecto_id;
            $actividades->delete();

            $totalActividades = actividades::where('proyecto_id', $proyecto_id);
            $promedio = round($totalActividades->avg('avance'));
            proyectos::where('id', $proyecto_id)->update(['avance' => $promedio]);

            $proyecto = proyectos::find($proyecto_id);

            if ($proyecto->avance > 0 && $proyecto->avance < 100) {
                proyectos::where('id', $proyecto_id)->update(['estado' => '2']);
                proyectos::where('id', $proyecto_id)->update(['prioridad' => '5']);
            } elseif ($proyecto->avance == 100) {
                proyectos::where('id', $proyecto_id)->update(['estado' => '3']);
                proyectos::where('id', $proyecto_id)->update(['prioridad' => '4']);
            }

            return redirect()->route('proyectos.actividades',$proyecto_id )
            ->with('success', 'Actividad Borrada Exitosamente.')->with('icon', 'success')->with('title', '¡Éxito!');
        } catch (\Exception $e) {
            return redirect()->route('proyectos.actividades',$proyecto_id )
            ->with('success', 'Actividad No se Pudo Borrar.')->with('icon', 'error')->with('title', 'ERROR!');
        }
    }

}
