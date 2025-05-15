<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulantesTable extends Migration
{
    public function up()
    {
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->date('fecha_nacimiento');
            $table->string('sexo');
            $table->string('estado_civil');
            $table->string('localidad');
            $table->string('domicilio');
            $table->text('estudios_cursados');
            $table->text('experiencia_laboral');
            $table->boolean('carnet_conducir')->default(0);
            $table->boolean('movilidad_propia')->default(0);
            $table->string('email')->unique();
            $table->string('telefono');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulantes');
    }
}
