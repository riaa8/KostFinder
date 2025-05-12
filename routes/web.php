<?php

use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\Kost_FasilitasController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Route untuk Pengguna
Route::prefix('pengguna')->group(function () {
    Route::post('/register', [PenggunaController::class, 'register']); // Register pengguna
    Route::post('/login', [PenggunaController::class, 'login']); // Login pengguna
    Route::get('/{id}', [PenggunaController::class, 'show']); // Menampilkan data pengguna
    Route::put('/{id}', [PenggunaController::class, 'update']); // Mengupdate data pengguna
    Route::delete('/{id}', [PenggunaController::class, 'destroy']); // Menghapus pengguna
});

// Route untuk Kost
Route::prefix('kost')->group(function () {
    Route::get('/', [KostController::class, 'index']); // Menampilkan semua kost
    Route::get('/{id}', [KostController::class, 'show']); // Menampilkan detail kost
    Route::post('/', [KostController::class, 'store']); // Menambahkan kost
    Route::put('/{id}', [KostController::class, 'update']); // Mengupdate kost
    Route::delete('/{id}', [KostController::class, 'destroy']); // Menghapus kost
});

// Route untuk Alamat
Route::prefix('kost/{kostId}/alamat')->group(function () {
    Route::get('/', [AlamatController::class, 'show']); // Menampilkan alamat untuk kost
    Route::post('/', [AlamatController::class, 'store']); // Menambahkan alamat untuk kost
    Route::put('/', [AlamatController::class, 'update']); // Mengupdate alamat untuk kost
    Route::delete('/', [AlamatController::class, 'destroy']); // Menghapus alamat untuk kost
});

// Route untuk master Fasilitas
Route::prefix('fasilitas')->group(function () {
    Route::get('/', [FasilitasController::class, 'index']); // Menampilkan semua fasilitas
    Route::get('/{id}', [FasilitasController::class, 'show']); // Menampilkan detail fasilitas
    Route::post('/', [FasilitasController::class, 'store']); // Menambahkan fasilitas baru
    Route::put('/{id}', [FasilitasController::class, 'update']); // Mengupdate fasilitas
    Route::delete('/{id}', [FasilitasController::class, 'destroy']); // Menghapus fasilitas
});


// Route untuk Kost_Fasilitas
Route::prefix('kost/{kostId}/fasilitas')->group(function () {
    Route::get('/', [Kost_FasilitasController::class, 'show']); // Menampilkan fasilitas untuk kost
    Route::post('/', [Kost_FasilitasController::class, 'store']); // Menambahkan fasilitas untuk kost
    Route::delete('/', [Kost_FasilitasController::class, 'destroy']); // Menghapus fasilitas dari kost
});

// Route untuk Review
Route::prefix('kost/{kostId}/review')->group(function () {
    Route::get('/', [ReviewController::class, 'index']); // Menampilkan semua review untuk kost
    Route::post('/', [ReviewController::class, 'store']); // Menambahkan review untuk kost
    Route::put('/{id}', [ReviewController::class, 'update']); // Mengupdate review
    Route::delete('/{id}', [ReviewController::class, 'destroy']); // Menghapus review
});
