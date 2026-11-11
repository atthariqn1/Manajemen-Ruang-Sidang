<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuangSidangController;
use Illuminate\Support\Facades\Route;

// Rute Autentikasi (Tamu / Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Rute Logout (Khusus Pengguna Login)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rute CRUD Master Ruang & Fasilitas Sidang (Dilindungi Autentikasi)
Route::middleware('auth')->group(function () {
    Route::get('/', [RuangSidangController::class, 'index'])->name('ruang-sidang.index');
    Route::post('/ruang-sidang', [RuangSidangController::class, 'store'])->name('ruang-sidang.store');
    Route::get('/ruang-sidang/{ruangSidang}/edit', [RuangSidangController::class, 'edit'])->name('ruang-sidang.edit');
    Route::put('/ruang-sidang/{ruangSidang}', [RuangSidangController::class, 'update'])->name('ruang-sidang.update');
    Route::delete('/ruang-sidang/{ruangSidang}', [RuangSidangController::class, 'destroy'])->name('ruang-sidang.destroy');
});
