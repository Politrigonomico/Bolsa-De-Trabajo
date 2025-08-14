<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carnet;

class CarnetsSeeder extends Seeder
{
    public function run()
    {
        $carnets = [
            ['carnetTipo' => 'A1 - Ciclomotor'],
            ['carnetTipo' => 'A2 - Motocicleta hasta 150cc'],
            ['carnetTipo' => 'A3 - Motocicleta de cualquier cilindrada'],
            ['carnetTipo' => 'B1 - Automóvil hasta 3500kg'],
            ['carnetTipo' => 'B - Automóvil'],
            ['carnetTipo' => 'C1 - Camión liviano'],
            ['carnetTipo' => 'C - Camión'],
            ['carnetTipo' => 'D1 - Transporte de pasajeros liviano'],
            ['carnetTipo' => 'D - Transporte de pasajeros'],
            ['carnetTipo' => 'E - Transporte de cargas peligrosas'],
        ];

        foreach ($carnets as $carnet) {
            Carnet::create($carnet);
        }

    }
}
