<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'razon_social',
        'cuit',
        'rubro_empresa',
        'contacto',
        'telefono',
        'email',
        'observacion',
    ];
}
