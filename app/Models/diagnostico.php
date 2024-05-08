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
        'grupodiagnosticos_id',
        'observacion',
        'resultados'
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
