<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyectos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'area',
        'fecha_estimada',
        'avance',
        'prioridad',
        'estado',
    ];

    static $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
        'fecha_estimada'=> 'required',
        'area' => 'required',
        'avance' => 'required',
        'prioridad' => 'required',
    ];


    public function user()
    {
        return $this->belngsTo(User::class);
    }

    public function areas()
    {
        return $this->hasOne(vs_areas::class,'id','area');
    }

    public function prioridades()
    {
        return $this->hasOne(vs_prioridades::class,'id','prioridad');
    }

    public function estados()
    {
        return $this->hasOne(vs_estados::class,'id','estado');
    }
}
