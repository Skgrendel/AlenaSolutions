<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('reportes.index');
    }

    public function vixor() {

        return view('reportes.vixor');
    }

    public function operacion(){
        return view('reportes.operaciones');
    }

    public function qanalytic(){
        return view('reportes.qdata');
    }

    public function proderiIndex(){
        return view('reportes.proderi.index');
    }

    public function proderiAdatos(){
        return view('reportes.proderi.analisisdedatos');
    }
    public function proderiAdministrativo(){
        return view('reportes.proderi.administrativa');
    }
    public function proderiAdministrativocompras(){
        return view('reportes.proderi.administrativo.solicitudcompra');
    }
    public function proderiAdministrativopermisos(){
        return view('reportes.proderi.administrativo.solicitudpermisos');
    }
    public function proderidepartamentoit(){
        return view('reportes.proderi.it');
    }
    public function proderidepartamentoitsoporte(){
        return view('reportes.proderi.it.solicitudsoporte');
    }
}
