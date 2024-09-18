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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('idpeminjaman'); 
            $table->string('id_user', 30); 
            $table->unsignedBigInteger('idbuku'); 
            $table->date('tanggal_pinjam'); 
            $table->date('tanggal_kembali')->nullable(); 
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam'); 
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('idbuku')->references('idbuku')->on('buku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
