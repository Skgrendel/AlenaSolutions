<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {

        if (auth()->user()->hasRole('Administrador')) {
            return view('reportes.index');
        } elseif (auth()->user()->hasRole('Cliente')) {
            return view('reportes.index');
        } elseif (auth()->user()->hasRole('Empleado')) {
            return redirect()->route('proyectos.index');
        } else {
            return view('dashboard.home');
        }

    }
}
