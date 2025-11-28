<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal'; // sesuaikan nama tabel

    protected $fillable = [
        'judul',
        'deskripsi',
        'status',
        'siswa_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
