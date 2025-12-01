<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    // Nama tabel (opsional, kalau otomatis jamak)
    protected $table = 'pelanggarans';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama_siswa',
        'kelas',
        'jurusan',
        'pelanggaran',
        'kategori',   // <-- pastikan ini ditambahkan
        'tanggal',
    ];

    // (Opsional) format tanggal otomatis
    protected $dates = ['tanggal'];
}
