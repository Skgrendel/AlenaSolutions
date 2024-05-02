<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personals extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'direccion',
        'correo',
        'estado',
    ];

    static $rules = [
        'tipo_documento' => 'required',
        'numero_documento' =>'required',
        'nombres'=>'required',
        'correo'=>'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
