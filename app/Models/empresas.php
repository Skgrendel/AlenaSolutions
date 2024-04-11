<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nit',
        'correo',
        'direccionp',
        'direccions',
        'telefono',
        'movil',
        'estado',
    ];

    static $rules = [
        'nombre' => 'required',
        'nit'=> 'required',
        'correo'=> 'required',
        'direccionp'=> 'required',
        'movil'=> 'required',
    ];
}
