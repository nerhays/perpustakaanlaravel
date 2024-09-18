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
        Schema::create('setting_menu_user', function (Blueprint $table) {
            $table->string('no_setting', 30)->primary();
            $table->string('id_jenis_user', 30); 
            $table->string('menu_id', 30); 
            $table->string('create_by', 30)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->char('delete_mark', 1)->default('0');
            $table->timestamp('create_date')->useCurrent();
            $table->timestamp('update_date')->nullable();
            
            // Foreign keys
            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_user');
            $table->foreign('menu_id')->references('menu_id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_menu_user');
    }
};
