<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RubrosTableSeeder extends Seeder
{
    public function run()
    {
        $rubros = [
            'Construcción',
            'Educación',
            'Salud',
            'Tecnología',
            'Administración',
            'Ventas',
            'Transporte',
            'Agricultura',
            'Turismo',
            'Diseño gráfico',
            'Marketing',
            'Finanzas',
            'Legal',
            'Recursos Humanos',
            'Hostelería',
            'Manufactura',
            'Comercio',
            'Mecánica',
            'Electricidad',
            'Gas y Plomería',
            'Ingeniería Civil',
            'Ingeniería Industrial',
            'Ingeniería en Sistemas',
            'Arquitectura',
            'Periodismo',
            'Comunicación Social',
            'Publicidad',
            'Cine y TV',
            'Fotografía',
            'Música',
            'Docencia',
            'Psicología',
            'Trabajo Social',
            'Medicina Veterinaria',
            'Biología',
            'Química',
            'Física',
            'Matemáticas',
            'Ciencias Ambientales',
            'Geografía',
            'Historia',
            'Arte',
            'Carpintería',
            'Panadería',
            'Gastronomía',
            'Atención al cliente',
            'Seguridad',
            'Limpieza',
            'Call Center',
            'Relaciones Internacionales',
            'Comercio Exterior',
            'Logística',
            'Reparto',
            'Producción audiovisual',
            'Jardinería',
            'Moda y Textil',
            'Diseño de interiores',
            'Reparación de electrodomésticos',
            'Videojuegos',
            'Desarrollo Web',
        ];

        foreach ($rubros as $rubro) {
            DB::table('rubros')->insert([
                'rubro' => $rubro,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
    
}
