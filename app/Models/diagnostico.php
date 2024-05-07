<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diagnostico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'objetivo',
        'preguntas_id',
        'grupodiagnosticos_id',
        'calificacion_id',
        'observacion'
    ];

    public function preguntas()
    {
        return $this->belongsTo(preguntas::class);
    }

    public function grupodiagnosticos()
    {
        return $this->belongsTo(grupodiagnostico::class);
    }

    public function calificacion()
    {
        return $this->belongsTo(calificaciones::class);
    }
}
