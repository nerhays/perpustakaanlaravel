<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class setting_menu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting_menu_user')->insert([
            // Admin - Full access to user management
            ['no_setting' => '1', 'id_jenis_user' => '1', 'menu_id' => '1'],

            // Penjaga Perpus - CRUD books, categories, and view borrow/return data
            ['no_setting' => '3', 'id_jenis_user' => '2', 'menu_id' => '3'],
            ['no_setting' => '4', 'id_jenis_user' => '2', 'menu_id' => '4'],
            ['no_setting' => '5', 'id_jenis_user' => '2', 'menu_id' => '5'],

            // Mahasiswa - Borrow and return books
            ['no_setting' => '6', 'id_jenis_user' => '3', 'menu_id' => '6'], 
            ['no_setting' => '7', 'id_jenis_user' => '3', 'menu_id' => '7'], 
        ]);
    }
}
