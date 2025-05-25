<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToPicsTable extends Migration
{
    public function up()
    {
        Schema::table('pics', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
    }

    public function down()
    {
        Schema::table('pics', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}