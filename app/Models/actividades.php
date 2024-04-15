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
    ];


    static $rules = [
        'proyecto_id' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'prioridad' => 'required',
        'estado' => 'required',
    ];

    public function proyecto()
    {
        return $this->belongsTo(proyectos::class);
    }

    public function prioridad()
    {
        return $this->belongsTo(vs_prioridades::class);
    }

    public function estado()
    {
        return $this->belongsTo(vs_estados::class);
    }


}
