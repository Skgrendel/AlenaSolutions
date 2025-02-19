<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividades extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'nombre',
        'descripcion',
        'observaciones',
        'personal_asignado',
        'fecha_estimada',
        'avance',
        'prioridad',
        'estado',
        'fecha_inicio',
        'fecha_final',
    ];


    static $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
        'prioridad' => 'required',

    ];

    public function proyectos()
    {
        return $this->belongsTo(proyectos::class);
    }

    public function prioridades()
    {
        return $this->hasOne(vs_prioridades::class, 'id', 'prioridad');
    }

    public function estados()
    {
        return $this->hasOne(vs_estados::class, 'id', 'estado');
    }


}
