<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bukus')->insert([
            [
                'judul' => 'Harry Potter',
                'penulis' => 'J.K. Rowling',
                'tahun_terbit' => 1997,
                'kategori_id' => 1,
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'The Lord of the Rings',
                'penulis' => 'J.R.R. Tolkien',
                'tahun_terbit' => 1954,
                'kategori_id' => 1,
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Sapiens',
                'penulis' => 'Yuval Noah Harari',
                'tahun_terbit' => 2011,
                'kategori_id' => 2,
                'stok' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kamus Bahasa Indonesia',
                'penulis' => 'Tim Penyusun',
                'tahun_terbit' => 2020,
                'kategori_id' => 3,
                'stok' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'tahun_terbit' => 2018,
                'kategori_id' => 2,
                'stok' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
