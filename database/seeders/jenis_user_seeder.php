<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class jenis_user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_user')->insert([
            ['id_jenis_user' => '1', 'jenis_user' => 'admin'],
            ['id_jenis_user' => '2', 'jenis_user' => 'penjaga_perpus'],
            ['id_jenis_user' => '3', 'jenis_user' => 'mahasiswa'],
        ]);
    }
}
