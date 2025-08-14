<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Localidad;

class LocalidadesSeeder extends Seeder
{
    public function run()
    {
        $localidades = [
            ['nombre' => 'Arroyo Seco', 'provincia' => 'Santa Fe', 'codigo_postal' => '2128'],
            ['nombre' => 'Rosario', 'provincia' => 'Santa Fe', 'codigo_postal' => '2000'],
            ['nombre' => 'Villa Constitución', 'provincia' => 'Santa Fe', 'codigo_postal' => '2919'],
            ['nombre' => 'San Lorenzo', 'provincia' => 'Santa Fe', 'codigo_postal' => '2200'],
            ['nombre' => 'Puerto General San Martín', 'provincia' => 'Santa Fe', 'codigo_postal' => '2142'],
            ['nombre' => 'Capitán Bermúdez', 'provincia' => 'Santa Fe', 'codigo_postal' => '2154'],
            ['nombre' => 'Fray Luis Beltrán', 'provincia' => 'Santa Fe', 'codigo_postal' => '2155'],
            ['nombre' => 'Pueblo Esther', 'provincia' => 'Santa Fe', 'codigo_postal' => '2144'],
            ['nombre' => 'Alvear', 'provincia' => 'Santa Fe', 'codigo_postal' => '2013'],
            ['nombre' => 'General Lagos', 'provincia' => 'Santa Fe', 'codigo_postal' => '2141'],
        ];

        foreach ($localidades as $localidad) {
            Localidad::create($localidad);
        }
    }
}
