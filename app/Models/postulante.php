<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'email',
        'domicilio',
        'localidad',
        'rubro_id',
        'fecha_nacimiento',
        'estado_civil',
        'experiencia_laboral',
        'estudios_cursados',
        'estudios_primaria',
        'estudios_secundaria', 
        'estudios_terciario',
        'estudios_universidad',
        'cursando_primaria',
        'cursando_secundaria',
        'cursando_terciario',
        'cursando_universidad',
        'certificado_check',
        'carnet_check',
        'tipo_carnet',
        'movilidad_propia',
        'sexo',
        'foto',
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function rubros()
    {
        return $this->belongsToMany(Rubro::class, 'postulante_rubro');
    }

    public function carnets()
    {
        return $this->belongsToMany(Carnet::class, 'postulante_carnet');
    }
}