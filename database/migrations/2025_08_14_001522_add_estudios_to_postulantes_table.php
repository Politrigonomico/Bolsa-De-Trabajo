<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('postulantes', function (Blueprint $table) {
            // Estudios completados
            $table->boolean('estudios_primaria')->default(false)->after('estudios_cursados');
            $table->boolean('estudios_secundaria')->default(false)->after('estudios_primaria');
            $table->boolean('estudios_terciario')->default(false)->after('estudios_secundaria');
            $table->boolean('estudios_universidad')->default(false)->after('estudios_terciario');
            
            // Estudios en curso
            $table->boolean('cursando_primaria')->default(false)->after('estudios_universidad');
            $table->boolean('cursando_secundaria')->default(false)->after('cursando_primaria');
            $table->boolean('cursando_terciario')->default(false)->after('cursando_secundaria');
            $table->boolean('cursando_universidad')->default(false)->after('cursando_terciario');
        });
    }

    public function down()
    {
        Schema::table('postulantes', function (Blueprint $table) {
            $table->dropColumn([
                'estudios_primaria', 'estudios_secundaria', 'estudios_terciario', 'estudios_universidad',
                'cursando_primaria', 'cursando_secundaria', 'cursando_terciario', 'cursando_universidad'
            ]);
        });
    }
};