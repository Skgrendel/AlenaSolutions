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

        $datatable = proyectos::where('user_id', auth()->id())->get();

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

        if ($request->finalizado == 1) {

            $proyecto = new proyectos();
            $imagenes = [];
            if ($request->hasFile('responseFiles')) {
                foreach ($request->file('responseFiles') as $imagen) {
                    $path = 'imagen/';
                    $nombre = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                    $imagen->move($path, $nombre);
                    // Añade el nombre del archivo al array
                    $imagenes[] = $nombre;
                }

            }
            $proyecto->imagenes = json_encode($imagenes);
            $proyecto->nombre = request('nombre');
            $proyecto->descripcion = request('descripcion');
            $proyecto->area = request('area');
            $proyecto->prioridad = request('prioridad');
            $proyecto->user_id = auth()->id();
            $proyecto->estado = 3;
            $proyecto->fecha_final = request('fecha_final');
            $proyecto->fecha_inicio = request('fecha_inicio');
            $proyecto->avance = 100;
            $proyecto->save();
            return redirect()->route('proyectos.index')->with('success', 'Proyecto Finalizado exitosamente.')
                ->with('icon', 'success')->with('title', '¡Éxito!');
        }else{

            $proyecto = new proyectos();
            $imagenes = [];
            if ($request->hasFile('responseFiles')) {
                foreach ($request->file('responseFiles') as $imagen) {
                    $path = 'imagen/';
                    $nombre = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                    $imagen->move($path, $nombre);
                    // Añade el nombre del archivo al array
                    $imagenes[] = $nombre;
                }

            }
            $proyecto->imagenes = json_encode($imagenes);
            $proyecto->user_id = auth()->id();
            $proyecto->fill($request->all());
            $proyecto->save();
            return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.')
                ->with('icon', 'success')->with('title', '¡Éxito!');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = proyectos::findOrFail($id);
        $proyecto->imagenes = json_decode($proyecto->imagenes);
        return view('proyectos.show', compact('proyecto'));
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

        if ($request->finalizado == 1) {
            $imagenes = [];
            if ($request->hasFile('responseFiles')) {
                foreach ($request->file('responseFiles') as $imagen) {
                    $path = 'imagen/';
                    $nombre = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                    $imagen->move($path, $nombre);
                    // Añade el nombre del archivo al array
                    $imagenes[] = $nombre;
                }

            }
            $proyecto->imagenes = json_encode($imagenes);
            $proyecto->estado = 3;
            $proyecto->fecha_final = request('fecha_final');
            $proyecto->fecha_inicio = request('fecha_inicio');
            $proyecto->avance = 100;
            $proyecto->update();
            return redirect()->route('proyectos.index')->with('success', 'Proyecto Finalizado exitosamente.')
                ->with('icon', 'success')->with('title', '¡Éxito!');
        }

        $imagenes = [];
        if ($request->hasFile('responseFiles')) {
            foreach ($request->file('responseFiles') as $imagen) {
                $path = 'imagen/';
                $nombre = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($path, $nombre);
                // Añade el nombre del archivo al array
                $imagenes[] = $nombre;
            }

        }
        $proyecto->imagenes = json_encode($imagenes);
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
            return redirect()->route('proyectos.index' )
            ->with('success', 'Proyecto Borrado Exitosamente.')->with('icon', 'success')->with('title', '¡Éxito!');
        } catch (\Exception $e) {
            return redirect()->route('proyectos.index' )
            ->with('success', 'el Proyecto No se Pudo Borrar.')->with('icon', 'error')->with('title', '¡Error!');
        }
    }


    public function actividades($id)
    {
        $proyecto = proyectos::find($id);
        $actividades = actividades::where('proyecto_id', $id)->with('prioridades')->get();
        return view('actividades.index',compact('actividades','proyecto'));
    }
}
