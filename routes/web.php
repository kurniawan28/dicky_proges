<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\ChatBKController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\SiswaController;

// ===== Halaman awal =====
Route::get('/', function () {
    return auth()->check() ? redirect()->route('welcome') : redirect()->route('welcome');
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
        if ($role === 'GURU_BK') return redirect()->route('dashboard.admin');
        if ($role === 'ADMIN') return redirect()->route('dashboard.kepsek');
        if ($role === 'SISWA') return redirect()->route('dashboard.user');
        abort(403, "Role tidak dikenali!");
    })->name('dashboard');

    // ===== CHAT AI =====
    Route::middleware('role:SISWA,GURU_BK,ADMIN')->group(function () {
        Route::get('/chat-bk', [ChatBKController::class, 'index'])->name('chat.bk');
        Route::post('/chat-bk/send', [ChatBKController::class, 'chat'])->name('chat.bk.send');
    });

    // ================================
    //  ROUTE KHUSUS GURU BK + ADMIN
    // ================================
    Route::middleware('role:GURU_BK,ADMIN')->group(function () {

        // Data Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

        // Pelanggaran CRUD
        Route::post('/pelanggaran', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
        Route::get('/pelanggaran/{id}/edit', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
        Route::put('/pelanggaran/{id}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
        Route::delete('/pelanggaran/{id}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');

        // Konseling
        Route::get('/konseling', [KonselingController::class, 'index'])->name('konseling.index');
        Route::get('/konseling/{id}/edit', [KonselingController::class, 'edit'])->name('konseling.edit');
        Route::put('/konseling/{id}', [KonselingController::class, 'update'])->name('konseling.update');
        Route::delete('/konseling/{id}', [KonselingController::class, 'destroy'])->name('konseling.destroy');
        Route::post('/konseling/{id}/status', [KonselingController::class, 'updateStatus'])->name('konseling.updateStatus');

        // =====================================================
        // ROUTE ACC & TOLAK PENGAJUAN KONSELING  (FIX TERBARU)
        // =====================================================
        Route::post('/konseling/{id}/acc', [JadwalController::class, 'acc'])->name('konseling.acc');
        Route::post('/konseling/{id}/tolak', [JadwalController::class, 'tolak'])->name('konseling.tolak');
    });

    // ===== VISI & MISI =====
    Route::middleware('role:SISWA,GURU_BK,ADMIN')->group(function () {
        Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
    });

    // ================================
    //  DASHBOARD GURU BK
    // ================================
    Route::middleware('role:GURU_BK,ADMIN')->group(function () {

        Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');

        // Jadwal CRUD
        Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

        // CRUD SISWA
        Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    });

    // ================================
    //  DASHBOARD ADMIN (GURU BK)
    // ================================
    Route::middleware('role:ADMIN')->group(function () {

        Route::get('/dashboard/admin-sekolah', fn() => view('dashboard.admin_sekolah'))->name('dashboard.kepsek');

        // Prestasi
        Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
        Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    });

    // ================================
    //  DASHBOARD SISWA
    // ================================
    Route::middleware('role:SISWA')->group(function () {
        Route::get('/dashboard/user', fn() => view('dashboard.user'))->name('dashboard.user');

        // Siswa buat pengajuan konseling
        Route::get('/konseling/create', [KonselingController::class, 'create'])->name('konseling.create');
        Route::post('/konseling', [KonselingController::class, 'store'])->name('konseling.store');
    });

    // ===== Halaman Umum =====
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/datasiswa', fn() => view('datasiswa'))->name('datasiswa.index');
    Route::get('/monitoring', [PelanggaranController::class, 'index'])->name('monitoring.index');
    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
});
