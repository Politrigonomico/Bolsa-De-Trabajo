<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('carnets', function (Blueprint $table) {
            $table->id();
            $table->string('carnetTipo', 250);
            $table->string('tipo_carnet', 250)->nullable();
            
            $table->timestamps();
        });


    }

};