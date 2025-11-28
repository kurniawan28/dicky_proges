<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('jadwal', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('siswa_id');
    $table->string('judul')->nullable();
    $table->text('deskripsi')->nullable();
    $table->string('status')->default('Menunggu');
    $table->date('tanggal')->nullable();
    $table->time('jam')->nullable();
    $table->timestamps();

    $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
});

}
public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
