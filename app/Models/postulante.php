<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'dni', 'fecha_nacimiento', 'sexo', 'estado_civil',
        'localidad', 'domicilio', 'estudios_cursados', 'experiencia_laboral',
        'carnet_conducir', 'movilidad_propia', 'email', 'telefono'
    ];
    

}
