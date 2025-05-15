<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $table = 'postulantes';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'email',
        'domicilio',
        'localidad',
        'estado_civil',
        'profesion',
        'experiencia_laboral',
        'estudios_cursados',
        'carnet_conducir',
        'movilidad_propia',
        'sexo',
        'fecha_nacimiento'
    ];

    public $timestamps = false;
}
