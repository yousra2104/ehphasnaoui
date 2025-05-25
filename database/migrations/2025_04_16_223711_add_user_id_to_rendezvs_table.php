<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Step 1: Add user_id column if it doesn't exist
        if (!Schema::hasColumn('rendezvs', 'user_id')) {
            Schema::table('rendezvs', function (Blueprint $table) {
                $table->bigInteger('user_id')->unsigned()->nullable()->after('id');
            });
        }

        // Step 2: Ensure valid user_id values for existing records
        $defaultUserId = DB::table('users')->value('id') ?? 1; // Get first user ID or fallback to 1
        DB::table('rendezvs')->whereNull('user_id')->update(['user_id' => $defaultUserId]);

        // Step 3: Check if foreign key exists, drop if necessary
        $foreignKeys = DB::select("SELECT CONSTRAINT_NAME 
                                   FROM information_schema.KEY_COLUMN_USAGE 
                                   WHERE TABLE_NAME = 'rendezvs' 
                                   AND COLUMN_NAME = 'user_id' 
                                   AND CONSTRAINT_SCHEMA = DATABASE() 
                                   AND REFERENCED_TABLE_NAME = 'users'");

        if (!empty($foreignKeys)) {
            Schema::table('rendezvs', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        // Step 4: Make user_id NOT NULL and add foreign key
        Schema::table('rendezvs', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('rendezvs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
