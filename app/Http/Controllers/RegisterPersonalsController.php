<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\User;
use App\Models\vs_areas;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RegisterPersonalsController extends Controller
{
   public function index()
    {
        $areas = vs_areas::pluck('nombre', 'id');
        $userRoles = null;
        return view('auth.register', compact('areas'));
    }

    public  function store(Request $request)
    {
        $request->validate(personals::$rules);

        // Validar existencia de personal por número de documento
        $userCorreo = $request['correo'];
        $userRol = $request['rol'];
        $existingPersonal = personals::where('numero_documento', $request->input('numero_documento'))->first();

        if ($existingPersonal) {
            // Si ya existe personal con ese número de documento, muestra un mensaje de error y redirige
            return redirect()->back()->with('success', 'Ya existe un Usuario con este número de documento.')->with('title', 'Error')->with('icon', 'error');;
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
        $Role = Role::where('name', 'Empleado')->first();
        $user->assignRole($Role);

        // Asociar usuario al personal creado
        $user->personal_id = $personal_id; //
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Usuario Creado con Exito.')
            ->with('tittle', 'Exito')
            ->with('icon', 'success');
    }
}
