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
            $table->string('cuil', 13);
            $table->string('telefono', 20);
            $table->string('celular', 20);
            $table->string('mail', 250);
            $table->string('domicilio', 250);
            $table->string('ciudad', 250);
            $table->date('nacimiento');

            $table->foreignId('titulo_id')->constrained('titulos');
            $table->string('cursos', 250);
            $table->string('observacionEdu', 250);

            $table->foreignId('rubro_id')->constrained('rubros');
            $table->string('experiencia', 250);

            $table->boolean('empleado');
            $table->string('tipoEmpleo', 250);

            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('carnet_id')->constrained('carnets');
            $table->string('observacionCarnet', 250);

            $table->boolean('idiomas');
            $table->string('observacionIdioma', 250);

            $table->boolean('practica');
            $table->boolean('pasante');

            $table->date('vigencia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulantes');
    }
};
