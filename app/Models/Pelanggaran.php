<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional kalau tabelnya otomatis jamak)
    protected $table = 'pelanggarans';

    // Kolom yang bisa diisi massal (mass assignable)
    protected $fillable = [
        'nama_siswa',
        'kelas',
        'jurusan',
        'pelanggaran',
        'tanggal',
    ];

    // (Opsional) format tanggal otomatis
    protected $dates = ['tanggal'];
}