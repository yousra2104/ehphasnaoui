<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('conv_doctors', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('speciality');
        });
    }

    public function down()
    {
        Schema::table('conv_doctors', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
