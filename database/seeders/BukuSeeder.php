<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'kode' => 'NV-01',
                'judul' => 'Home Sweet Loan',
                'pengarang' => 'Almira Bastari',
                'idkategori' => 1 
            ],
            [
                'kode' => 'BO-01',
                'judul' => 'Mohammad Hatta, Untuk Negeriku',
                'pengarang' => 'Taufik Abdullah',
                'idkategori' => 2 
            ],
            [
                'kode' => 'NV-02',
                'judul' => 'Keajaiban Toko Kelontong Namiya',
                'pengarang' => 'Keigo Higashino',
                'idkategori' => 1 
            ],
        ]);
    }
}
