<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration 
{
    public function up()
    {
        Schema::table('organisms', function (Blueprint $table) {
            if (!Schema::hasColumn('organisms', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('logo');
            }
        });
    }

    public function down()
    {
        Schema::table('organisms', function (Blueprint $table) {
            if (Schema::hasColumn('organisms', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};