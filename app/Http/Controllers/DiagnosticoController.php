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

        $datas = array_slice($data, 4);
        $grupopreguntas = $this->agruparPreguntas($datas);


        // Insertar el JSON en la tabla
        diagnostico::create([
            'nombre' => $data['inputNombreDiagnostico'],
            'objetivo' => $data['inputDescripDiagnostico'],
            'grupodiagnosticos_id' => $data['id_diagnostico'],
            'resultados' => json_encode($grupopreguntas),
        ]);

        return redirect()->route('auditorias.index')->with('title', 'Exito')->with('icon', 'success')->with('success', 'Diagnóstico creado con éxito');
    }

    private function agruparPreguntas($data)
    {
        $grupo = [];
        $grupo_actual = 1;

        foreach ($data as $key => $value) {
            if (strpos($key, "grupo") !== false) {
                $grupo_actual = "grupo" . $value;
                $grupo[$grupo_actual] = [];
            } else {
                if (strpos($key, "preguntas_id") === false) continue;
                if (preg_match("/(\d+)$/", $key, $matches)) {
                    $num = $matches[0];
                    $grupo[$grupo_actual][] = [
                        "pregunta" => $data["preguntas_id{$num}"],
                        "resultado" => $data["resultado{$num}"],
                        "observaciones" => $data["observaciones{$num}"],
                    ];
                }
            }
        }
        return $grupo;
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
        $calificaciones = calificaciones::pluck('nombre', 'calificacion');
        $encabezados = encabezados_preguntas::all();
        return view('diagnosticos.create', compact('calificaciones', 'mods', 'encabezados', 'empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diagnostico = diagnostico::find($id);
        $resultados = json_decode($diagnostico->resultados, true);
        $suma = 0;
        $totalresultado = 0;
        // dd($resultados);
        foreach ($resultados as $key => $value) {

            foreach ($value as $item) {
                $suma += $item['resultado'];
                $totalresultado++;
            }
            $promedios[$key]["promedio"] = round( $suma / $totalresultado,0);
        }
        $Grupodiagnostico = grupodiagnostico::with('user')->where('id', $diagnostico->grupodiagnosticos_id)->first();
        return view('diagnosticos.informe', compact('diagnostico', 'Grupodiagnostico', 'promedios'));
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
