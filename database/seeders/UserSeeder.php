<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            ['nama_user' => 'admin','username' => 'admin', 'password' => Hash::make('admin123'), 'email' => 'admin@gmail.com', 'id_jenis_user' => '1', 'status_user' => 'active'],
            ['nama_user' => 'pjgperpus','username' => 'pjgperpus', 'password' => Hash::make('perpus123'), 'email' => 'pjgperpus@gmail.com', 'id_jenis_user' => '2', 'status_user' => 'active'],
        ]);
    }
}
