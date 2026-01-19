<?php

namespace Database\Seeders; // << harus ada

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // User::create([
        //     'name' => 'Dicky',
        //     'email' => 'dicky@gmail.com',
        //     'password' => Hash::make('password123'),
        //     'role' => 'SISWA',
        // ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ADMIN',
        ]);

        User::create([
            'name' => 'roni',
            'email' => 'roni@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'SISWA',
        ]);
    }
}
