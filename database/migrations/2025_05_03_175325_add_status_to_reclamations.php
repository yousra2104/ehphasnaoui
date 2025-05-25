<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToReclamations extends Migration
{
    public function up()
    {
        Schema::table('reclamations', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('solution');
        });
    }

    public function down()
    {
        Schema::table('reclamations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}