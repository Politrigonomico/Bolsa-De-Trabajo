<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RubrosTableSeeder::class,
            PostulantesTableSeeder::class,
            EmpresasSeeder::class,
            CarnetsSeeder::class,
            LocalidadesSeeder::class,
        ]);
    }
}
