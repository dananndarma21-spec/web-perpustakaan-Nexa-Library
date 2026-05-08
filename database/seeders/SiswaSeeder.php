<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('siswas')->insert([
            [
                'nama' => 'Siswa 1',
                'nis' => '12345',
                'kelas' => '10A',
                'jurusan' => 'IPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siswa 2',
                'nis' => '12346',
                'kelas' => '10B',
                'jurusan' => 'IPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siswa 3',
                'nis' => '12347',
                'kelas' => '11A',
                'jurusan' => 'IPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siswa 4',
                'nis' => '12348',
                'kelas' => '11B',
                'jurusan' => 'IPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siswa 5',
                'nis' => '12349',
                'kelas' => '12A',
                'jurusan' => 'IPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
