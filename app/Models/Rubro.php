<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $table = 'rubros';

    protected $fillable = [
        'rubro',
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
