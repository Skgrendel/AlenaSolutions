<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\proyectos;
use App\Models\vs_estados;
use App\Models\vs_prioridades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function create_activi(string $id)
    {
        $prioridades = vs_prioridades::pluck('nombre', 'id');
        $estados = vs_estados::pluck('nombre', 'id');
        $proyecto = proyectos::find($id);
        return view('actividades.create', compact('proyecto', 'estados', 'prioridades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos antes de crear la actividad
        $request->validate(actividades::$rules);

        // Crear la actividad con los datos del formulario
        $actividades = actividades::create($request->all());
        $proyecto_id = $request->proyecto_id;
        // Manejo de evidencias si se enviaron archivos
        if ($request->hasFile('responseFiles')) {
            $actividades->evidencias = json_encode($this->guardarEvidencias($request->file('responseFiles'), $request->input('personal_asignado'),$actividades));
            $actividades->save();
        }
        // Calcular el promedio de avance de todas las actividades del proyecto
        $promedio = actividades::where('proyecto_id', $proyecto_id)->avg('avance');
        $promedio = round($promedio); // Redondear a número entero

        // Obtener el proyecto y actualizar su avance
        $proyecto = proyectos::find($proyecto_id);
        $proyecto->update(['avance' => $promedio]);

        // Determinar estado y prioridad del proyecto en una sola actualización
        if ($proyecto->avance > 0 && $proyecto->avance < 100) {
            $proyecto->update(['estado' => '2', 'prioridad' => '5']);
        } elseif ($proyecto->avance == 100) {
            $proyecto->update(['estado' => '3', 'prioridad' => '4']);
        }

        // Determinar estado de la actividad en una sola consulta
        if ($actividades->avance > 0 && $actividades->avance < 100) {
            $actividades->update(['estado' => '2']);
        } elseif ($actividades->avance == 100) {
            $actividades->update(['estado' => '3']);
        }

        // Redireccionar con mensaje de éxito
        return redirect()->route('proyectos.actividades', $proyecto_id)
            ->with('success', 'Actividad creada correctamente.')
            ->with('icon', 'success')
            ->with('title', '¡Éxito!');
    }
    private function guardarEvidencias($files, $area, $actividad)
    {
        $area_slug = Str::slug($area, '_'); // Formato seguro para carpetas
        $nuevasEvidencias = [];

        foreach ($files as $file) {
            $nombreOriginal = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $nombreArchivo = uniqid() . "_" . Str::slug($nombreOriginal, '_') . "." . $extension;
            $path = Storage::disk('s3')->putFileAs("evidencias/$area_slug", $file, $nombreArchivo);
            $nuevasEvidencias[] = $path;
        }

        // Obtener evidencias existentes o inicializar como un array vacío
        $evidenciasExistentes = $actividad->evidencias ? json_decode($actividad->evidencias, true) : [];

        // Combinar evidencias existentes con las nuevas
        $evidenciasFinales = array_merge($evidenciasExistentes, $nuevasEvidencias);

        // Guardar en la base de datos
        $actividad->update(['evidencias' => json_encode($evidenciasFinales)]);

        return $evidenciasFinales;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prioridades = vs_prioridades::pluck('nombre', 'id');
        $estados = vs_estados::pluck('nombre', 'id');
        $actividades = actividades::find($id);
        $proyecto = proyectos::find($actividades->proyecto_id);
        return view('actividades.show',compact('estados', 'prioridades', 'proyecto','actividades'));

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
        // Obtener la actividad existente
        $actividades = actividades::findOrFail($id);
        $proyecto_id = $actividades->proyecto_id;

         // Manejo de evidencias si se enviaron archivos
         if ($request->hasFile('responseFiles')) {
            $actividades->evidencias = json_encode($this->guardarEvidencias($request->file('responseFiles'), $request->input('personal_asignado'),$actividades));
            $actividades->save();
        }
        // Validar el nuevo avance para que no sea menor al actual
        $request->validate([
            'avance' => ['required', 'numeric', 'min:' . $actividades->avance, 'max:100'],
        ]);

        // Actualizar la actividad con los datos nuevos
        $actividades->update($request->all());

        // Calcular el promedio de avance de todas las actividades del proyecto
        $promedio = round(actividades::where('proyecto_id', $proyecto_id)->avg('avance'));

        // Actualizar el avance del proyecto
        $proyecto = proyectos::find($proyecto_id);
        $proyecto->update(['avance' => $promedio]);

        // Determinar estado y prioridad del proyecto en una sola actualización
        if ($proyecto->avance > 0 && $proyecto->avance < 100) {
            $proyecto->update(['estado' => '2', 'prioridad' => '5']);
        } elseif ($proyecto->avance == 100) {
            $proyecto->update(['estado' => '3', 'prioridad' => '4']);
        }

        // Determinar estado de la actividad
        if ($actividades->avance > 0 && $actividades->avance < 100) {
            $actividades->update(['estado' => '2']);
        } elseif ($actividades->avance == 100) {
            $actividades->update(['estado' => '3']);
        }

        // Redireccionar con mensaje de éxito
        return redirect()->route('proyectos.actividades', $proyecto_id)
            ->with('success', 'Actividad actualizada correctamente.')
            ->with('icon', 'success')
            ->with('title', '¡Éxito!');
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

            return redirect()->route('proyectos.actividades', $proyecto_id)
                ->with('success', 'Actividad Borrada Exitosamente.')->with('icon', 'success')->with('title', '¡Éxito!');
        } catch (\Exception $e) {
            return redirect()->route('proyectos.actividades', $proyecto_id)
                ->with('success', 'Actividad No se Pudo Borrar.')->with('icon', 'error')->with('title', 'ERROR!');
        }
    }

}
