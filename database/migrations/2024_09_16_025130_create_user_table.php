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
        Schema::create('user', function (Blueprint $table) {
            $table->string('id_user', 30)->primary();
            $table->string('nama_user', 60);
            $table->string('username', 60)->unique();
            $table->string('password', 60);
            $table->string('email', 200)->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('wa', 30)->nullable();
            $table->string('pin', 30)->nullable();
            $table->string('id_jenis_user', 30); 
            $table->string('status_user', 30);
            $table->string('create_by', 30)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->char('delete_mark', 1)->default('0');
            $table->timestamp('create_date')->useCurrent();
            $table->timestamp('update_date')->nullable();
            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
