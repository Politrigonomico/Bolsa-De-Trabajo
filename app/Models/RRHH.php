<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;

class RRHH extends Model
{
    protected $table = 'rrhhs';

    protected $fillable = ['empresa_id', 'contacto', 'telefono', 'email'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
