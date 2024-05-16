<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personals extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'area',
        'correo',
        'estado',
    ];

    static $rules = [
        'tipo_documento' => 'required',
        'numero_documento' =>'required',
        'nombres'=>'required',
        'correo'=>'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function areas()
    {
        return $this->hasOne(vs_areas::class,'id','area');
    }


}
