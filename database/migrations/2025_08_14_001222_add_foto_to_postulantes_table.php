<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('postulantes', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('cv_pdf');
        });
    }

    public function down()
    {
        Schema::table('postulantes', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};