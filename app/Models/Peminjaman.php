<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Peminjaman extends Model
{
    /**
     * Nama tabel (plural Bahasa Indonesia).
     */
    protected $table = 'peminjaman';

    /**
     * Denda per hari keterlambatan: Rp 5.000
     */
    public const DENDA_PER_HARI = 5000;

    protected $fillable = [
        'siswa_id',
        'buku_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_pengembalian',
        'status',
        'denda',
    ];

    protected $casts = [
        'tanggal_pinjam'       => 'date',
        'tanggal_kembali'      => 'date',
        'tanggal_pengembalian' => 'date',
        'denda'                => 'integer',
    ];

    /**
     * Computed attributes otomatis di-append.
     */
    protected $appends = [
        'computed_status',
        'computed_denda',
        'hari_terlambat',
    ];

    // ──────────────────────────────────────────────
    //  RELATIONSHIPS
    // ──────────────────────────────────────────────

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ──────────────────────────────────────────────
    //  ACCESSORS
    // ──────────────────────────────────────────────

    /**
     * Status otomatis (realtime).
     *
     * "dikembalikan" → status DB dikembalikan ATAU ada tanggal_pengembalian
     * "terlambat"    → masih dipinjam DAN hari ini > deadline
     * "dipinjam"     → masih dipinjam DAN hari ini <= deadline
     */
    protected function computedStatus(): Attribute
    {
        return Attribute::get(function () {
            // Sudah dikembalikan (cek status DB DAN tanggal_pengembalian)
            if ($this->status === 'dikembalikan' || $this->tanggal_pengembalian) {
                return 'dikembalikan';
            }

            // Masih dipinjam → cek deadline
            if (!$this->tanggal_kembali) {
                return 'dipinjam';
            }

            $deadline = Carbon::parse($this->tanggal_kembali)->startOfDay();
            $today    = Carbon::today();

            // Hari ini > deadline → terlambat
            if ($today->greaterThan($deadline)) {
                return 'terlambat';
            }

            return 'dipinjam';
        });
    }

    /**
     * Jumlah hari terlambat.
     *
     * - Sudah dikembalikan → (tanggal_pengembalian - deadline)
     * - Masih dipinjam     → (hari ini - deadline)
     * - Hanya positif jika melewati deadline
     */
    protected function hariTerlambat(): Attribute
    {
        return Attribute::get(function () {
            if (!$this->tanggal_kembali) {
                return 0;
            }

            $deadline = Carbon::parse($this->tanggal_kembali)->startOfDay();

            // Tentukan tanggal pembanding
            if ($this->tanggal_pengembalian || $this->status === 'dikembalikan') {
                // Sudah dikembalikan
                if ($this->tanggal_pengembalian) {
                    $compareTo = Carbon::parse($this->tanggal_pengembalian)->startOfDay();
                } else {
                    // Dikembalikan tapi tanggal_pengembalian null → pakai hari ini
                    $compareTo = Carbon::today();
                }
            } else {
                // Belum dikembalikan → pakai hari ini
                $compareTo = Carbon::today();
            }

            // Hanya hitung jika pembanding > deadline
            if ($compareTo->greaterThan($deadline)) {
                return (int) $deadline->diffInDays($compareTo);
            }

            return 0;
        });
    }

    /**
     * Denda otomatis (realtime).
     *
     * - Sudah dikembalikan DAN denda di DB > 0 → tampilkan dari DB
     * - Sudah dikembalikan DAN denda di DB = 0 → hitung dari hari terlambat
     * - Masih dipinjam → hitung live
     */
    protected function computedDenda(): Attribute
    {
        return Attribute::get(function () {
            // Sudah dikembalikan dan denda sudah dihitung → pakai DB
            if ($this->status === 'dikembalikan' && $this->denda > 0) {
                return (int) $this->denda;
            }

            // Hitung dari hari terlambat (live atau dari tanggal_pengembalian)
            return $this->hari_terlambat * self::DENDA_PER_HARI;
        });
    }

    // ──────────────────────────────────────────────
    //  HELPER — untuk controller saat pengembalian
    // ──────────────────────────────────────────────

    /**
     * Hitung denda final saat buku dikembalikan.
     */
    public function calculateFinalDenda(?Carbon $returnDate = null): array
    {
        $returnDate = ($returnDate ?? Carbon::today())->startOfDay();

        if (!$this->tanggal_kembali) {
            return ['days' => 0, 'denda' => 0];
        }

        $deadline = Carbon::parse($this->tanggal_kembali)->startOfDay();

        if ($returnDate->greaterThan($deadline)) {
            $days = (int) $deadline->diffInDays($returnDate);
            return [
                'days'  => $days,
                'denda' => $days * self::DENDA_PER_HARI,
            ];
        }

        return ['days' => 0, 'denda' => 0];
    }
}
