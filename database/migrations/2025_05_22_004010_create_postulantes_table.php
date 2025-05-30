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
            $table->string('email', 250) ->unique();
            $table->string('estado_civil', 50);
            $table->string('profesion', 250)->nullable();
            $table->string('experiencia_laboral', 250)->nullable();
            $table->string('estudios_cursados', 250)->nullable();
            $table->boolean('carnet_conducir')->default(false);
            $table->boolean('movilidad_propia')->default(false);
            $table->string('sexo', 10)->nullable();
            $table->string('localidad', 250);
            $table->string('domicilio', 250);
            $table->date('nacimiento');

            $table->foreignId('titulo_id')->constrained('titulos');

            $table->foreignId('rubro_id')->constrained('rubros');
            $table->string('experiencia', 250);


            $table->foreignId('empresa_id')->constrained('empresas');

            $table->foreignId('carnet_id')->constrained('carnets');
            $table->string('observacionCarnet', 250);

            $table->boolean('idiomas') ->default(false);
            $table->string('observacionIdioma', 250);

            $table->date('vigencia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulantes');
    }
};
