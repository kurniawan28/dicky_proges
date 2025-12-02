<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin / Kepala Sekolah
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ADMIN',
        ]);

        // Guru BK
        User::create([
            'name' => 'Guru BK',
            'email' => 'guru.bk@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'GURU_BK',
        ]);

        // Wali Kelas
        User::create([
            'name' => 'Wali Kelas 1A',
            'email' => 'walikelas1a@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'WALI_KELAS',
            'kelas_id' => 1,
        ]);

        // Siswa
        User::create([
            'name' => 'Dicky',
            'email' => 'dicky@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'SISWA',
            'kelas_id' => 1,
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'SISWA',
            'kelas_id' => 1,
        ]);

        // Wali Murid
        User::create([
            'name' => 'Orang Tua Siswa A',
            'email' => 'ortuA@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'WALI_MURID',
            'kelas_id' => 1,
        ]);
    }
}
