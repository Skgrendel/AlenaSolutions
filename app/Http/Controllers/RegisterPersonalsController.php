<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RegisterPersonalsController extends Controller
{
   public function index()
    {
        $roles = Role::whereIn('name', ['Empleado'])->pluck('name', 'name')->all();
        $userRoles = null;
        return view('auth.register', compact('roles', 'userRoles'));
    }
}
