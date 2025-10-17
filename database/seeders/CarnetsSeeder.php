<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carnet;
use Illuminate\Support\Facades\DB;

class CarnetsSeeder extends Seeder
{
public function run()
{
    // Desactivar temporalmente las foreign keys
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('carnets')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $carnets = [
            [
                'carnetTipo' => 'A1',
                'tipo_carnet' => 'A1',
                'descripcion' => 'Ciclomotor hasta 50cc'
            ],
            [
                'carnetTipo' => 'A2',
                'tipo_carnet' => 'A2',
                'descripcion' => 'Motocicleta hasta 150cc'
            ],
            [
                'carnetTipo' => 'A3',
                'tipo_carnet' => 'A3',
                'descripcion' => 'Motocicleta de cualquier cilindrada'
            ],
            [
                'carnetTipo' => 'B1',
                'tipo_carnet' => 'B1',
                'descripcion' => 'Automóvil hasta 3500kg'
            ],
            [
                'carnetTipo' => 'B2',
                'tipo_carnet' => 'B2',
                'descripcion' => 'Automóvil y remolque hasta 750kg'
            ],
            [
                'carnetTipo' => 'C1',
                'tipo_carnet' => 'C1',
                'descripcion' => 'Camión hasta 12000kg'
            ],
            [
                'carnetTipo' => 'C',
                'tipo_carnet' => 'C',
                'descripcion' => 'Camión de más de 12000kg'
            ],
            [
                'carnetTipo' => 'D1',
                'tipo_carnet' => 'D1',
                'descripcion' => 'Transporte de pasajeros hasta 8 asientos'
            ],
            [
                'carnetTipo' => 'D2',
                'tipo_carnet' => 'D2',
                'descripcion' => 'Transporte de pasajeros de más de 8 asientos'
            ],
            [
                'carnetTipo' => 'D3',
                'tipo_carnet' => 'D3',
                'descripcion' => 'Transporte de pasajeros - servicio de urgencia'
            ],
            [
                'carnetTipo' => 'E1',
                'tipo_carnet' => 'E1',
                'descripcion' => 'Transporte de cargas peligrosas'
            ],
            [
                'carnetTipo' => 'E2',
                'tipo_carnet' => 'E2',
                'descripcion' => 'Transporte de cargas peligrosas (especializado)'
            ],
        ];

    foreach ($carnets as $carnet) {
        Carnet::create($carnet);
    }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($carnets as $carnet) {
            Carnet::create($carnet);
        }

    }
}