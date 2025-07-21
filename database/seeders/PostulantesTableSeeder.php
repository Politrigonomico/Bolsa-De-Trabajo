<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rubro;

class PostulantesTableSeeder extends Seeder
{
    public function run()
    {
        $rubroIds = Rubro::pluck('id')->toArray(); // Traigo todos los IDs de rubros

        for ($i = 1; $i <= 20; $i++) {
            DB::table('postulantes')->insert([
                'nombre' => "Postulante $i",
                'apellido' => "Apellido $i",
                'dni' => 40000000 + $i,
                'telefono' => '3412' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'email' => "postulante$i@example.com",
                'domicilio' => "Calle Falsa $i",
                'localidad' => "Localidad $i",
                'fecha_nacimiento' => now()->subYears(20 + $i)->format('Y-m-d'),
                'rubro_id' => $rubroIds[array_rand($rubroIds)], // ID random de rubro
                'experiencia_laboral' => "Experiencia laboral de prueba $i",
                'estudios_cursados' => "Estudios cursados $i",
                'certificado_check' => rand(0,1),
                'carnet_check' => rand(0,1),
                'tipo_carnet' => rand(0,1) ? 'A' : null,
                'movilidad_propia' => rand(0,1),
                'sexo' => (rand(0,1) ? 'M' : 'F'),
                'cv_pdf' => "cv_postulante_$i.pdf",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
