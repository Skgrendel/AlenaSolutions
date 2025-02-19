<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\proyectos;
use App\Models\vs_estados;
use App\Models\vs_areas;
use App\Models\vs_prioridades;
use App\Services\SagrilaftServices;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
            $evidencias = [];
            $area = str::slug($request->input('area'), '_'); // Convierte el área en un nombre seguro para carpetas
            if ($request->hasFile('responseFiles')) {
                foreach ($request->file('responseFiles') as $file) {
                    $nombreOriginal = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Obtener el nombre sin extensión
                    $extension = $file->getClientOriginalExtension(); // Obtener la extensión del archivo
                    $nombre = uniqid() . "_" . Str::slug($nombreOriginal, '_') . "." . $extension; // Generar nombre único

                    $path = Storage::disk('s3')->putFileAs("evidencias/$area", $file, $nombre);

                    // Guarda la URL en el array de evidencias
                    $evidencias[] = Storage::disk('s3')->url($path);
                }
            }

            // Guardar evidencias directamente como JSON
            $proyecto->evidencias = json_encode($evidencias, JSON_UNESCAPED_SLASHES);
            $proyecto->nombre = $request->input('nombre');
            $proyecto->descripcion = $request->input('descripcion');
            $proyecto->area = $request->input('area');
            $proyecto->prioridad = $request->input('prioridad');
            $proyecto->user_id = auth()->id();
            $proyecto->estado = 3;
            $proyecto->fecha_final = $request->input('fecha_final');
            $proyecto->fecha_inicio = $request->input('fecha_inicio');
            $proyecto->avance = 100;
            $proyecto->save();

            return redirect()->route('proyectos.index')
                ->with('success', 'Proyecto Finalizado exitosamente.')
                ->with('icon', 'success')
                ->with('title', '¡Éxito!');
        } else {

            $proyecto = new proyectos();
            $evidencias = [];
            $area = str::slug($request->input('area'), '_'); // Convierte el área en un nombre seguro para carpetas
            if ($request->hasFile('responseFiles')) {
                foreach ($request->file('responseFiles') as $file) {
                    $nombreOriginal = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Obtener el nombre sin extensión
                    $extension = $file->getClientOriginalExtension(); // Obtener la extensión del archivo
                    $nombre = uniqid() . "_" . Str::slug($nombreOriginal, '_') . "." . $extension; // Generar nombre único

                    $path = Storage::disk('s3')->putFileAs("evidencias/$area", $file, $nombre);

                    // Guarda la URL en el array de evidencias
                    $evidencias[] = Storage::disk('s3')->url($path);
                }
            }

            // Guardar evidencias directamente como JSON
            $proyecto->evidencias = json_encode($evidencias, JSON_UNESCAPED_SLASHES);
            $proyecto->user_id = auth()->id();
            $proyecto->fill($request->all());
            $proyecto->save();

            if ($request->input('sistema') == "1") {
                try {
                    $sagrilaft = new SagrilaftServices;
                    $sagrilaft->SistemaSagrilaft($proyecto->id);
                } catch (\Throwable $th) {
                    throw $th;
                }

            }
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
        $proyecto->evidencias = json_decode($proyecto->evidencias);
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

        $evidencias = json_decode($proyecto->evidencias, true) ?? []; // Mantener las evidencias previas

        if ($request->hasFile('responseFiles')) {
            $area = Str::slug($request->input('area'), '_'); // Convertir el área en un nombre seguro

            foreach ($request->file('responseFiles') as $file) {
                $nombreOriginal = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $nombre = uniqid() . "_" . Str::slug($nombreOriginal, '_') . "." . $extension;

                // Guardar archivo en S3 en la carpeta del área
                $path = Storage::disk('s3')->putFileAs("evidencias/$area", $file, $nombre);

                // Guardar la URL del archivo en el array de evidencias
                $evidencias[] = Storage::disk('s3')->url($path);
            }
        }

        $proyecto->evidencias = json_encode($evidencias, JSON_UNESCAPED_SLASHES);

        if ($request->finalizado == 1) {
            $proyecto->estado = 3;
            $proyecto->fecha_final = $request->input('fecha_final');
            $proyecto->fecha_inicio = $request->input('fecha_inicio');
            $proyecto->avance = 100;
            $proyecto->save();

            return redirect()->route('proyectos.index')
                ->with('success', 'Proyecto Finalizado exitosamente.')
                ->with('icon', 'success')
                ->with('title', '¡Éxito!');
        }

        // Actualizar el resto de los campos
        $proyecto->update($request->except('responseFiles'));

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto actualizado exitosamente.')
            ->with('icon', 'success')
            ->with('title', '¡Éxito!');
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
            return redirect()->route('proyectos.index')
                ->with('success', 'Proyecto Borrado Exitosamente.')->with('icon', 'success')->with('title', '¡Éxito!');
        } catch (\Exception $e) {
            return redirect()->route('proyectos.index')
                ->with('success', 'el Proyecto No se Pudo Borrar.')->with('icon', 'error')->with('title', '¡Error!');
        }
    }


    public function actividades($id)
    {
        $proyecto = proyectos::find($id);
        $actividades = actividades::where('proyecto_id', $id)->with('prioridades')->get();
        return view('actividades.index', compact('actividades', 'proyecto'));
    }
}
