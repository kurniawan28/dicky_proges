<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Sekolah',
                'email' => 'admin@sekolah.com',
                'password' => Hash::make('admin123'),
                'role' => 'KEPALA_SEKOLAH',
                'kelas_id' => null,
            ],
            [
                'name' => 'Guru BK',
                'email' => 'guru.bk@sekolah.com',
                'password' => Hash::make('guru123'),
                'role' => 'GURU_BK',
                'kelas_id' => null,
            ],
            [
                'name' => 'Wali Kelas 1A',
                'email' => 'walikelas1a@sekolah.com',
                'password' => Hash::make('wali123'),
                'role' => 'WALI_KELAS',
                'kelas_id' => 1, // sesuaikan dengan id kelas
            ],
            [
                'name' => 'Siswa A',
                'email' => 'siswaA@sekolah.com',
                'password' => Hash::make('siswa123'),
                'role' => 'SISWA',
                'kelas_id' => 1,
            ],
            [
                'name' => 'Orang Tua Siswa A',
                'email' => 'ortuA@sekolah.com',
                'password' => Hash::make('ortu123'),
                'role' => 'WALI_MURID',
                'kelas_id' => 1,
            ],
        ]);
    }
}
