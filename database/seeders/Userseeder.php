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

        // Create Kelas & Wali Kelas for each Department
        $jurusans = ['RPL', 'TITL', 'TKR', 'TPM'];
        foreach ($jurusans as $j) {
            $kelasId = \Illuminate\Support\Facades\DB::table('kelas')->insertGetId([
                'nama_kelas' => "XII $j",
                'jurusan' => $j,
                'tingkat' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Wali Kelas per Jurusan
            User::updateOrCreate(
                ['email' => 'wali_' . strtolower($j) . '@gmail.com'],
                [
                    'name' => "Wali Kelas $j",
                    'password' => Hash::make('password123'),
                    'role' => 'WALI_KELAS',
                    'kelas_id' => $kelasId,
                    'jurusan' => $j,
                ]
            );

            // Dummy Siswa for each Jurusan
            User::updateOrCreate(
                ['email' => 'siswa_' . strtolower($j) . '@gmail.com'],
                [
                    'name' => "Siswa $j",
                    'password' => Hash::make('password123'),
                    'role' => 'SISWA',
                    'kelas_id' => $kelasId,
                    'jurusan' => $j,
                ]
            );
        }
    }
}
