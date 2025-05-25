<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('actualites', function (Blueprint $table) {
            // Change description to TEXT
            $table->text('description')->nullable()->change();
            // Add date_ajout column
            $table->timestamp('date_ajout')->nullable()->after('type');
            // Optionally, change type to enum
            $table->enum('type', ['événement', 'annonce', 'article'])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('actualites', function (Blueprint $table) {
            // Revert description to VARCHAR(255)
            $table->string('description')->nullable()->change();
            // Drop date_ajout column
            $table->dropColumn('date_ajout');
            // Revert type to VARCHAR(255)
            $table->string('type')->nullable()->change();
        });
    }
};