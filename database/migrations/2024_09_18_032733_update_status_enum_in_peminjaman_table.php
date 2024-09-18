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
        if (Schema::hasColumn('peminjaman', 'status')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->enum('status', ['dipinjam', 'dikembalikan', 'menunggu_verifikasi'])
                ->default('menunggu_verifikasi')
                ->after('tanggal_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->enum('status', ['dipinjam', 'dikembalikan'])
                ->default('dipinjam')
                ->after('tanggal_kembali');
        });
    }
};
