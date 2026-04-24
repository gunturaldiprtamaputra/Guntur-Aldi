<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ─── KHUSUS ADMIN ─────────────────────────────────
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
        Route::resource('anggota', AnggotaController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::patch('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])
            ->name('peminjaman.kembali');
    });

    // ─── SEMUA USER ────────────────────────────────────
    Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
    Route::post('/koleksi/pinjam', [KoleksiController::class, 'pinjam'])->name('koleksi.pinjam');
    Route::post('/pinjam', [PinjamController::class, 'store'])->name('pinjam.store');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';