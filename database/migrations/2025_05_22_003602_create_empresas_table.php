<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('empresas', function (Blueprint $table) {
        $table->id();
        $table->string('razonSocial', 250)->unique();
        $table->string('cuit', 13);
        $table->string('rubro', 250);
        $table->string('contacto', 250);
        $table->string('telefono', 250);
        $table->string('celular', 250);
        $table->string('mail', 250);
        $table->string('observacionEmp', 250);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
