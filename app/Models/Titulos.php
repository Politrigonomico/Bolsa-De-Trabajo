<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulos extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}
