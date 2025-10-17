<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'carnetTipo',
        'tipo_carnet',
        'descripcion',
    ];

    public function postulantes()
    {
        return $this->belongsToMany(Postulante::class, 'postulante_carnet');
    }

    // Accessor para mantener compatibilidad
    public function getTipoCarnetAttribute($value)
    {
        return $value ?? $this->attributes['carnetTipo'] ?? null;
    }
}