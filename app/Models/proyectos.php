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
        'user_id' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'area' => 'required',
        'prioridad' => 'required',
        'estado' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(vs_areas::class);
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
