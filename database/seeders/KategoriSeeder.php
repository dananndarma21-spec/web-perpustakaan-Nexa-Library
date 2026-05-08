<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Fiksi',
                'keterangan' => 'Buku fiksi dan cerita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Non-Fiksi',
                'keterangan' => 'Buku non-fiksi dan pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Referensi',
                'keterangan' => 'Buku referensi dan kamus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
