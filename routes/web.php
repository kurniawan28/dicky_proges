<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\StatistikController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('welcome')
        : redirect()->route('welcome');
});

// Halaman public
Route::get('/welcome', fn() => view('welcome'))->name('welcome');

// ===== AUTH =====
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== DASHBOARD TERPROTEKSI =====
Route::middleware('auth')->group(function () {

    // Redirect dashboard sesuai role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'GURU_BK') {
            return redirect()->route('dashboard.admin');
        } elseif ($role === 'SISWA') {
            return redirect()->route('dashboard.user');
        } else {
            abort(403, "Role tidak dikenali!");
        }
    })->name('dashboard');

    // ===== DASHBOARD ADMIN (GURU_BK) =====
    Route::middleware('role:GURU_BK')->group(function () {
        Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');

        // Jadwal
        Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

        // Pelanggaran
        Route::post('/pelanggaran', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
        Route::put('/pelanggaran/{id}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
        Route::delete('/pelanggaran/{id}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');

        // Prestasi
        Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
        Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');

        // Konseling (admin bisa lihat, edit, update status, dan hapus)
        Route::get('/konseling', [KonselingController::class, 'index'])->name('konseling.index');
        Route::get('/konseling/{id}/edit', [KonselingController::class, 'edit'])->name('konseling.edit'); 
        Route::put('/konseling/{id}', [KonselingController::class, 'update'])->name('konseling.update'); 
        Route::delete('/konseling/{id}', [KonselingController::class, 'destroy'])->name('konseling.destroy');
        Route::post('/konseling/{id}/status', [KonselingController::class, 'updateStatus'])->name('konseling.updateStatus');
    });

    // ===== DASHBOARD SISWA =====
    Route::middleware('role:SISWA')->group(function () {
        Route::get('/dashboard/user', fn() => view('dashboard.user'))->name('dashboard.user');

        // Konseling (siswa bisa buat ajukan)
        Route::get('/konseling/create', [KonselingController::class, 'create'])->name('konseling.create');
        Route::post('/konseling', [KonselingController::class, 'store'])->name('konseling.store');
    });

    // ===== Halaman bisa dilihat admin & siswa =====
    Route::get('/datasiswa', fn() => view('datasiswa'))->name('datasiswa.index');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/monitoring', [PelanggaranController::class, 'index'])->name('monitoring.index');
    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
});