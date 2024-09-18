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
        Schema::table('peminjaman', function (Blueprint $table) {
          
            $table->dropForeign(['id_user']);
            
            $table->unsignedBigInteger('id_user')->nullable(false)->change();
            
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            $table->dropForeign(['id_user']);
            
            $table->unsignedBigInteger('id_user')->nullable()->change();
            
            $table->foreign('id_user')->references('id')->on('users');
        });
    }
};
