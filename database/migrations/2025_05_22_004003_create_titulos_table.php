<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('titulos', function (Blueprint $table) {
            $table->id(); 
            $table->string('titulo', 250)->unique();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('titulos');
    }
};
