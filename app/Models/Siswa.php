<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['nama', 'nis', 'kelas', 'jurusan'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
