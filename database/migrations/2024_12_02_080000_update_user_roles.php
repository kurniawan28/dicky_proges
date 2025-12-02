<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateUserRoles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update role 'admin' menjadi 'GURU_BK'
        DB::table('users')
            ->where('role', 'admin')
            ->update(['role' => 'GURU_BK']);

        // Update role 'user' menjadi 'SISWA'
        DB::table('users')
            ->where('role', 'user')
            ->update(['role' => 'SISWA']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: kembalikan ke role lama
        DB::table('users')
            ->where('role', 'GURU_BK')
            ->update(['role' => 'admin']);

        DB::table('users')
            ->where('role', 'SISWA')
            ->update(['role' => 'user']);
    }
}
