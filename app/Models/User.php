<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'role',      // role: 'GURU_BK', 'ADMIN', atau 'SISWA'
        'password',
        'kelas_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Helper: cek apakah user Guru BK
     */
    public function isGuruBK()
    {
        return $this->role === 'GURU_BK';
    }

    /**
     * Helper: cek apakah user Admin (Ex Kepala Sekolah)
     */
    public function isAdmin()
    {
        return $this->role === 'ADMIN';
    }

    /**
     * Helper: cek apakah user Siswa
     */
    public function isUser()
    {
        return $this->role === 'SISWA';
    }
}
