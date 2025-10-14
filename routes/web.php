<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;

// Halaman welcome
Route::get('/welcome', function () {
    return view('welcome'); // pastikan file welcome.blade.php ada
})->name('welcome');

// Redirect root ke welcome
Route::get('/', function () {
    return redirect()->route('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Prestasi
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');


// Tambahkan ini untuk datasiswa
Route::get('/datasiswa', fn() => view('datasiswa'))->name('datasiswa.index');

 // Tambahkan route konseling
    Route::get('/konseling', fn() => view('konseling'))->name('konseling.index');
    Route::get('/konseling/create', fn() => view('konseling-create'))->name('konseling.create');

    Route::get('/statistik', fn() => view('statistik'))->name('statistik.index');

    Route::get('/monitoring', fn() => view('monitoring'))->name('monitoring.index');

    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');


// Dashboard (auth only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


