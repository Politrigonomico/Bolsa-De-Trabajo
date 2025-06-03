<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->integer('dni')->unique();
            $table->string('telefono', 20);
            $table->string('email', 250)->unique();
            $table->string('domicilio', 250);
            $table->string('localidad', 250);
            $table->date('fecha_nacimiento');
            $table->string('estado_civil', 50)->nullable();
            $table->foreignId('rubro_id')->constrained('rubros')->onDelete('cascade');
            $table->string('experiencia_laboral', 250)->nullable();
            $table->string('estudios_cursados', 250)->nullable();
            $table->boolean('certificado_check')->default(false);
            $table->boolean('carnet_check')->default(false);
            $table->string('tipo_carnet', 100)->nullable();
            $table->boolean('movilidad_propia')->default(false);
            $table->string('sexo', 10)->nullable();
            $table->string('cv_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulantes');
    }
};
