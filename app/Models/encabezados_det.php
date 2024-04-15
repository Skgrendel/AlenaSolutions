<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encabezados_det extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nomenclatura',
    ];

    public function encabezados()
    {
        return $this->belongsTo(encabezados::class);
    }

}
