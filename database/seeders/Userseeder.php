<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'ADMIN',
            ]
        );

        // Create Kelas
        $kelasId = \Illuminate\Support\Facades\DB::table('kelas')->insertGetId([
            'nama_kelas' => 'XII RPL 1',
            'jurusan' => 'RPL',
            'tingkat' => 12,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Wali Kelas
        User::updateOrCreate(
            ['email' => 'wali_kelas@gmail.com'],
            [
                'name' => 'Wali Kelas',
                'password' => Hash::make('password123'),
                'role' => 'WALI_KELAS',
                'kelas_id' => $kelasId,
            ]
        );

        // Siswa (Linked to Class)
        User::updateOrCreate(
            ['email' => 'siswa_rpl@gmail.com'],
            [
                'name' => 'Siswa RPL',
                'password' => Hash::make('password123'),
                'role' => 'SISWA',
                'kelas_id' => $kelasId,
            ]
        );

    }
}
