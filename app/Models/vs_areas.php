<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vs_areas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nomenclatura',
    ];

    public function proyectos()
    {
        return $this->hasMany(proyectos::class);
    }

    public function actividades()
    {
        return $this->hasMany(actividades::class);
    }
}
