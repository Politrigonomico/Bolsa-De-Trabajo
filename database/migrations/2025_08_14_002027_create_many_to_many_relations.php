<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Crear tabla para múltiples rubros por postulante
        Schema::create('postulante_rubro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulante_id')->constrained('postulantes')->onDelete('cascade');
            $table->foreignId('rubro_id')->constrained('rubros')->onDelete('cascade');
            $table->timestamps();
        });

        // Crear tabla para múltiples carnets por postulante
        Schema::create('postulante_carnet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulante_id')->constrained('postulantes')->onDelete('cascade');
            $table->foreignId('carnet_id')->constrained('carnets')->onDelete('cascade');
            $table->timestamps();
        });

        // Agregar columna descripcion a la tabla carnets
        Schema::table('carnets', function (Blueprint $table) {
            // Se agrega al final, sin intentar borrar columnas inexistentes
            $table->string('descripcion')->nullable();
        });
    }

    public function down()
    {
        // Borrar tablas de relación
        Schema::dropIfExists('postulante_rubro');
        Schema::dropIfExists('postulante_carnet');

        // Eliminar columna descripcion de carnets
        Schema::table('carnets', function (Blueprint $table) {
            $table->dropColumn('descripcion');
        });
    }
};
