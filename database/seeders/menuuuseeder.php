<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class menuuuseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //menu_level
        DB::table('menu_level')->insert([
            ['id_level' => '1', 'level' => 'Admin'],
            ['id_level' => '2', 'level' => 'Penjaga Perpus'],
            ['id_level' => '3', 'level' => 'Mahasiswa'],
        ]);

        //menu
        DB::table('menu')->insert([
            // Menu for Admin
            ['menu_id' => '1', 'id_level' => '1', 'menu_name' => 'Manage Users', 'menu_link' => '/admin/users', 'menu_icon' => 'fas fa-users'],

            // Menu for Penjaga Perpus
            ['menu_id' => '3', 'id_level' => '2', 'menu_name' => 'Manage Buku', 'menu_link' => '/penjaga/buku', 'menu_icon' => 'fas fa-book'],
            ['menu_id' => '4', 'id_level' => '2', 'menu_name' => 'Manage Kategori', 'menu_link' => '/penjaga/kategori', 'menu_icon' => 'fas fa-tags'],
            ['menu_id' => '5', 'id_level' => '2', 'menu_name' => 'Peminjaman', 'menu_link' => '/penjaga/peminjaman', 'menu_icon' => 'fas fa-exchange-alt'],

            // Menu for Mahasiswa
            ['menu_id' => '6', 'id_level' => '3', 'menu_name' => 'Buku', 'menu_link' => '/mhs/buku', 'menu_icon' => 'fas fa-book-open'],
            ['menu_id' => '7', 'id_level' => '3', 'menu_name' => 'Riwayat Peminjaman', 'menu_link' => '/mhs/riwayat', 'menu_icon' => 'fas fa-undo'],
        ]);
    }
}
