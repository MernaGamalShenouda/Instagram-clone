<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('full_name');
            $table->string('username');
            $table->string('gender');
            $table->string('website')->nullable();
            $table->string('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('avatar')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('full_name');
            $table->dropColumn('username');
            $table->dropColumn('gender');
            $table->dropColumn('website');
            $table->dropColumn('bio');
            $table->dropColumn('image');
            $table->dropColumn('avatar');
        });
        
    }
};
