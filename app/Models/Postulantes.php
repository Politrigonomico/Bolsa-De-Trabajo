<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulantes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'dni', 'cuil', 'telefono', 'email',
        'domicilio', 'ciudad', 'nacimiento', 'titulo_id', 'cursos', 'observacionEdu',
        'rubro_id', 'experiencia_laboral', 
        'empresa_id', 'carnet_id', 'observacionCarnet',
        'idiomas', 'observacionIdioma', 'practica', 'pasante', 'vigencia'
    ];
    public function rubros()
    {
        return $this->belongsTo(Rubros::class);
    }
    public function titulos()
    {
        return $this->belongsTo(Titulos::class);
    }
    public function empresas()
    {
        return $this->belongsTo(Empresas::class);
    }

}