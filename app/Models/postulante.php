<?php

// app/Models/Postulante.php

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
        'certificado_check',
        'carnet_check',
        'tipo_carnet',
        'movilidad_propia',
        'sexo',
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

}
