<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuangSidangController;
use Illuminate\Support\Facades\Route;

// Rute Autentikasi (Tamu / Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Rute Logout (Khusus Pengguna yang Sudah Login)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rute Modul Ruang Sidang (Hak Akses: Admin & Petugas)
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    // 1. Read (Lihat Data)
    Route::get('/', [RuangSidangController::class, 'index'])->name('ruang-sidang.index');

    // 2. Create (Tambah Data)
    Route::post('/ruang-sidang', [RuangSidangController::class, 'store'])->name('ruang-sidang.store');

    // 3. Update (Ubah Data)
    Route::get('/ruang-sidang/{ruangSidang}/edit', [RuangSidangController::class, 'edit'])->name('ruang-sidang.edit');
    Route::put('/ruang-sidang/{ruangSidang}', [RuangSidangController::class, 'update'])->name('ruang-sidang.update');

    // 4. Delete (Hapus Data - Dibatasi Khusus Role Admin dengan Middleware)
    Route::delete('/ruang-sidang/{ruangSidang}', [RuangSidangController::class, 'destroy'])
        ->middleware('role:admin')
        ->name('ruang-sidang.destroy');
});
