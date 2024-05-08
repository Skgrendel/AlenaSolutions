<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preguntas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta',
        'grupo',
    ];

    public function diagnosticos()
    {
        return $this->hasMany(diagnostico::class);
    }


}
