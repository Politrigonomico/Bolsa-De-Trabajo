<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RRHH;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'razon_social',
        'cuit',
        'rubro_empresa',
        'observacion',
    ];
    public function rrhh()
    {
        return $this->hasOne(RRHH::class);
    }

}
