<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function vixor() {

        return view('reportes.vixor');
    }

    public function operacion(){
        return view('reportes.operaciones');
    }
}
