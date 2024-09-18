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
        Schema::create('jenis_user', function (Blueprint $table) {
            $table->string('id_jenis_user', 30)->primary();
            $table->string('jenis_user', 60);
            $table->string('create_by', 30)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->char('delete_mark', 1)->default('0');
            $table->timestamp('create_date')->useCurrent();
            $table->timestamp('update_date')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_user');
    }
};
