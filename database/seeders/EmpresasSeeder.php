<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\RRHH;

class EmpresasSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $empresa = Empresa::create([
                'razon_social' => "Empresa $i",
                'cuit' => '20-1234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'rubro_empresa' => 'Tecnología',
                'observacion' => 'Observación de prueba',
            ]);

            $empresa->rrhh()->create([
                'contacto' => "Contacto $i",
                'telefono' => "0341-480$i",
                'email' => "contacto$i@empresa.com",
            ]);
        }
    }
}
