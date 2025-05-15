<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('dni') ->unique();
            $table->integer('telefono');
            $table->string('email') ->unique();
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('estado_civil');
            $table->string('profesion') -> nullable();
            $table->string('experiencia_laboral') -> nullable();
            $table->string('estudios_cursados') -> nullable();
            $table->boolean('carnet_conducir') -> default(false);
            $table->string('movilidad_propia') -> default(false);
            $table->string('sexo') -> default('no especificado');
            $table->date('fecha_nacimiento');
            $table->timestamp('created_at') -> useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantes');
    }
};
