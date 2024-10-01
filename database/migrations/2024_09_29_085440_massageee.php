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
        Schema::create('message_kategori', function (Blueprint $table) {
            $table->string('no_mk', 30)->primary();
            $table->string('description', 50);
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
        });
        
        Schema::create('message', function (Blueprint $table) {
            $table->id('message_id');  // Auto-incrementing primary key
            $table->unsignedInteger('sender');  
            $table->string('message_reference', 30)->nullable();
            $table->string('subject', 300);
            $table->text('message_text');
            $table->string('message_status', 30);
            $table->string('no_mk', 30); 
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
        
            $table->foreign('sender')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('no_mk')->references('no_mk')->on('message_kategori')->onDelete('cascade');
        });
        
        Schema::create('message_dokumen', function (Blueprint $table) {
            $table->id('no_mdok');  // Auto-incrementing primary key
            $table->string('file', 200);
            $table->string('description', 150)->nullable();
            $table->unsignedBigInteger('message_id');  // Change to unsignedBigInteger
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
        
            $table->foreign('message_id')->references('message_id')->on('message')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_kategori');
        Schema::dropIfExists('message');
        Schema::dropIfExists('message_dokumen');
        Schema::dropIfExists('message_to');
    }
};
