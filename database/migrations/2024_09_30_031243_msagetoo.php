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
        Schema::create('message_to', function (Blueprint $table) {
            $table->id('no_record');
            $table->unsignedBigInteger('message_id');
            $table->unsignedInteger('to');
            $table->string('cc', 30)->nullable();
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
        
            $table->foreign('message_id')->references('message_id')->on('message')->onDelete('cascade');
            $table->foreign('to')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_to');
    }
};
