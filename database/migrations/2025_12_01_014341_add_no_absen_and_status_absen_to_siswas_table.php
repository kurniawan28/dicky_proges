<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('no_absen')->unique()->after('id');
            $table->enum('status_absen', ['Hadir','Tidak Hadir','Izin','Sakit'])->default('Hadir')->after('no_hp');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn(['no_absen', 'status_absen']);
        });
    }
};
