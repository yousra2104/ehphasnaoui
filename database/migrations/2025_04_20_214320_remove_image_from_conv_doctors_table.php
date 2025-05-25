<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveImageFromConvDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('conv_doctors', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down()
    {
        Schema::table('conv_doctors', function (Blueprint $table) {
            $table->string('image')->nullable()->after('speciality');
        });
    }
}