<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PersonalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datatable = personals::all();
        return view('personal.index', compact('datatable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = null;
        return view('personal.create', compact('roles', 'userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(personals::$rules);

        // Validar existencia de personal por número de documento
        $userCorreo = $request['correo'];
        $userRol = $request['rol'];
        $existingPersonal = personals::where('numero_documento', $request->input('numero_documento'))->first();

        if ($existingPersonal) {
            // Si ya existe personal con ese número de documento, muestra un mensaje de error y redirige
            return redirect()->back()->with('success', 'Ya existe un personal con este número de documento.')->with('title', 'Error');
        }
        // Si no existe, crea el personal
        $data = $request->all();
        $personal = personals::create($data);
        $personal_id = $personal->id;

        // Crear usuario
        $user = new User([
            'email' => $userCorreo,
            'password' => bcrypt($request['numero_documento']),
        ]);

        // Asignar roles al usuario
        $Role = Role::where('name', $userRol)->first();
        $user->assignRole($Role);

        // Asociar usuario al personal creado
        $user->personal_id = $personal_id; //
        $user->save();

        return redirect()->route('personals.index')
            ->with('success', 'Personal Creado con Exito.')
            ->with('tittle', 'Exito')
            ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(personals $personals)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personals $personals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personals $personals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $proyecto = personals::findOrFail($id);
            $proyecto->delete();
            return response()->json(['success' => 'Usuario eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el Usuario.'], 500);
        }
    }
}
