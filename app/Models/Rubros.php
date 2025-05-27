<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubros extends Model
{
    protected $table = 'rubros';
    
    protected $fillable = [
        'rubro',
    ];
    
    public function postulantes()
    {
        return $this->hasMany(Postulantes::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresas::class);
    }
}
