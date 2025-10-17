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
        'cv_pdf',
    ];

    protected $casts = [
        'estudios_primaria' => 'boolean',
        'estudios_secundaria' => 'boolean',
        'estudios_terciario' => 'boolean',
        'estudios_universidad' => 'boolean',
        'cursando_primaria' => 'boolean',
        'cursando_secundaria' => 'boolean',
        'cursando_terciario' => 'boolean',
        'cursando_universidad' => 'boolean',
        'certificado_check' => 'boolean',
        'carnet_check' => 'boolean',
        'movilidad_propia' => 'boolean',
        'fecha_nacimiento' => 'date',
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

    // Método helper para obtener todas las profesiones
    public function todasLasProfesiones()
    {
        $profesiones = collect();
        
        if ($this->rubro) {
            $profesiones->push($this->rubro->rubro);
        }
        
        if ($this->rubros && $this->rubros->count() > 0) {
            foreach ($this->rubros as $rubro) {
                if ($rubro->id !== $this->rubro_id) {
                    $profesiones->push($rubro->rubro);
                }
            }
        }
        
        return $profesiones->unique()->values();
    }

    // Método para determinar nivel educativo más alto
    public function nivelEducativoMasAlto()
    {
        if ($this->estudios_universidad || $this->cursando_universidad) {
            return 'Universidad';
        }
        if ($this->estudios_terciario || $this->cursando_terciario) {
            return 'Terciario';
        }
        if ($this->estudios_secundaria || $this->cursando_secundaria) {
            return 'Secundaria';
        }
        if ($this->estudios_primaria || $this->cursando_primaria) {
            return 'Primaria';
        }
        return null;
    }
}