<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('postulantes', function (Blueprint $table) {
            $table->string('experiencia_laboral', 700)->nullable()->change();
            $table->string('estudios_cursados', 600)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('postulantes', function (Blueprint $table) {
            $table->string('experiencia_laboral', 500)->nullable()->change();
            $table->string('estudios_cursados', 500)->nullable()->change();
        });
    }
};