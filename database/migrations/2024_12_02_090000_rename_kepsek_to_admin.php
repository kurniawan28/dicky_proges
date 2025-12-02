<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Modify column to include 'ADMIN'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('GURU_BK', 'WALI_KELAS', 'SISWA', 'WALI_MURID', 'KEPALA_SEKOLAH', 'ADMIN')");

        // 2. Update data
        DB::table('users')
            ->where('role', 'KEPALA_SEKOLAH')
            ->update(['role' => 'ADMIN']);
            
        // 3. (Optional) Modify column to remove 'KEPALA_SEKOLAH' - let's keep it for safety or remove it?
        // Let's keep it for now to avoid issues if rollback needed, or just leave it.
        // Ideally we should clean it up:
        // DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('GURU_BK', 'WALI_KELAS', 'SISWA', 'WALI_MURID', 'ADMIN')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Revert data
        DB::table('users')
            ->where('role', 'ADMIN')
            ->update(['role' => 'KEPALA_SEKOLAH']);

        // 2. Revert column definition
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('GURU_BK', 'WALI_KELAS', 'SISWA', 'WALI_MURID', 'KEPALA_SEKOLAH')");
    }
};
