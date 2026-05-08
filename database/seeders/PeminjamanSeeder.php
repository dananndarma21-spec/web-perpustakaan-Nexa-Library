<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('peminjaman')->insert([
            [
                'siswa_id' => 1,
                'buku_id' => 1,
                'user_id' => 1,
                'tanggal_pinjam' => $now->copy()->subDays(20)->format('Y-m-d'),
                'tanggal_kembali' => $now->copy()->subDays(10)->format('Y-m-d'),
                'status' => 'dikembalikan',
                'denda' => 25000, // 5 days late stored manually
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'siswa_id' => 2,
                'buku_id' => 2,
                'user_id' => 1,
                'tanggal_pinjam' => $now->copy()->subDays(15)->format('Y-m-d'),
                'tanggal_kembali' => $now->copy()->subDays(5)->format('Y-m-d'),
                'status' => 'dipinjam', // This should trigger dynamic fine (5 days x 5000 = 25000)
                'denda' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'siswa_id' => 3,
                'buku_id' => 3,
                'user_id' => 1,
                'tanggal_pinjam' => $now->copy()->subDays(2)->format('Y-m-d'),
                'tanggal_kembali' => $now->copy()->addDays(5)->format('Y-m-d'),
                'status' => 'dipinjam', // This is safe, no fine
                'denda' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'siswa_id' => 4,
                'buku_id' => 4,
                'user_id' => 1,
                'tanggal_pinjam' => $now->copy()->subDays(30)->format('Y-m-d'),
                'tanggal_kembali' => $now->copy()->subDays(20)->format('Y-m-d'),
                'status' => 'dipinjam', // Heavily late
                'denda' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
