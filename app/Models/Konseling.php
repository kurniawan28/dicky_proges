<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_siswa',
        'kelas',
        'absen',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'permasalahan',
        'guru_bk',
        'status',
        'alasan_penolakan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
