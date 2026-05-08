<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::all()->count();
        $totalKategori = Kategori::all()->count();
        $totalBuku = Buku::all()->count();
        $totalPeminjaman = Peminjaman::all()->count();

        $recentPeminjaman = Peminjaman::with(['siswa', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        $aktivPeminjaman = Peminjaman::with(['siswa', 'buku'])
            ->where('status', 'dipinjam')
            ->latest()
            ->take(10)
            ->get();

        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('D d/m');
            $chartData[] = DB::table('peminjamans')->whereDate('created_at', $date)->count();
        }

        return view('dashboard', compact(
            'totalSiswa',
            'totalKategori',
            'totalBuku',
            'totalPeminjaman',
            'recentPeminjaman',
            'aktivPeminjaman',
            'chartLabels',
            'chartData'
        ));
    }
}
