<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
 {
     Schema::create('prestasis', function (Blueprint $table) {
         $table->id();
         $table->string('nama_siswa');
         $table->string('kelas');
         $table->string('jurusan');
         $table->string('prestasi');
         $table->string('tahun');
         $table->timestamps();
     });
 }
};