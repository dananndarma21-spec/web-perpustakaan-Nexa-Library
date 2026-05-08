<?php
// Final verification
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Peminjaman;
use Carbon\Carbon;

echo "Today: " . Carbon::today()->format('Y-m-d') . "\n\n";

// Trigger the same repair as controller index does
$controller = new App\Http\Controllers\PeminjamanController();
// The repair runs on every index() call, so we simulate via reflection
$method = new ReflectionMethod($controller, 'repairCorruptData');
$method->setAccessible(true);
$method->invoke($controller);

echo "=== ALL RECORDS (after repair) ===\n\n";

$records = Peminjaman::all();
echo str_pad('ID', 4) . str_pad('Status DB', 15) . str_pad('Pinjam', 13) . str_pad('Deadline', 13) . str_pad('Kembali', 13) . str_pad('Denda DB', 10) . str_pad('Computed', 15) . str_pad('Late', 6) . "Denda\n";
echo str_repeat('-', 100) . "\n";

foreach ($records as $r) {
    echo str_pad($r->id, 4);
    echo str_pad($r->status, 15);
    echo str_pad($r->tanggal_pinjam->format('Y-m-d'), 13);
    echo str_pad($r->tanggal_kembali ? $r->tanggal_kembali->format('Y-m-d') : 'NULL', 13);
    echo str_pad($r->tanggal_pengembalian ? $r->tanggal_pengembalian->format('Y-m-d') : 'NULL', 13);
    echo str_pad($r->denda, 10);
    echo str_pad($r->computed_status, 15);
    echo str_pad($r->hari_terlambat . 'd', 6);
    echo 'Rp ' . number_format($r->computed_denda, 0, ',', '.') . "\n";
}

echo "\n✅ Verification complete\n";
