<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route autentikasi (login, logout, register, reset password) dari laravel/ui
Auth::routes(['verify' => false, 'confirm' => false]);

// Semua halaman aplikasi hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // Route Halaman Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Master Data Kelas (parameter dinamai {kelas}, bukan {kela} hasil singularisasi otomatis)
    Route::resource('kelas', KelasController::class)->except(['show'])
        ->parameters(['kelas' => 'kelas']);

    // Master Data Siswa
    Route::resource('siswa', SiswaController::class)
        ->parameters(['siswa' => 'siswa']);

    // Master Data Guru
    Route::resource('guru', GuruController::class)->except(['show'])
        ->parameters(['guru' => 'guru']);

    // Master Data Mata Pelajaran (Mapel)
    Route::resource('mapel', MapelController::class)->except(['show'])
        ->parameters(['mapel' => 'mapel']);

    // Data Nilai Akademik
    Route::resource('nilai', NilaiController::class)->except(['show'])
        ->parameters(['nilai' => 'nilai']);
});
