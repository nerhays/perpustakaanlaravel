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
        Schema::table('buku', function (Blueprint $table) {
            if (!Schema::hasColumn('buku', 'status_buku')) {
                $table->enum('status_buku', ['1', '0'])->default('1')->after('idkategori');
            }
        });

        Schema::table('peminjaman', function (Blueprint $table) {
            $table->date('tanggal_kembali')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::table('buku', function (Blueprint $table) {
            if (Schema::hasColumn('buku', 'status_buku')) {
                $table->dropColumn('status_buku');
            }
        });
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->date('tanggal_kembali')->nullable(false)->change();
        });
    }
};
