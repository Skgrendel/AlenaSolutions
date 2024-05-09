<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupodiagnostico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_grupo',
        'user_id', // Add this line to the fillable array
        'descripcion_grupo',
        'nombre_empresa',
        'nit_empresa',
        'correo_empresa',
        'direccion_empresa',
        'direccion_empresa2',
        'telefono_fijo',
        'telefono_celular',
        'nombre_oficial_cumplimiento',
    ];

    static $rules = [
        'nombre_grupo' => 'required',
        'descripcion_grupo' =>'required',
        'nombre_empresa'=>'required',
        'nit_empresa'=>'required',
        'correo_empresa'=>'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    public function diagnosticos()
    {
        return $this->hasMany(diagnostico::class, 'grupodiagnosticos_id');
    }

}
