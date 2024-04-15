<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encabezados extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nomenclatura',
    ];

    public function encabezados_det()
    {
        return $this->hasMany(encabezados_det::class);
    }
}
