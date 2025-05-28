<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\admin\AnggotaController;
use App\Http\Controllers\admin\KeluargaController;
use App\Http\Controllers\admin\StatisticController;
use App\Http\Controllers\user\AnggotaPendikarController;
use App\Http\Controllers\admin\DiskusiController;
use App\Http\Controllers\user\TanggapanController;
use App\Http\Controllers\User\DashboardController; // Tambahkan ini

Route::get('/', function () {
    return redirect()->route('register');
});

Route::middleware('auth')->group(function () {

    // Update route dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.statistik');
        } else {
            return app(DashboardController::class)->index();
        }
    })->name('dashboard');

    // Route untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Route untuk lihat anggota pendikar
    Route::get('/anggota-keluarga', [AnggotaPendikarController::class, 'index'])->name('anggota.index');

    // Route diskusi - pindahkan ke dalam middleware auth
    Route::resource('diskusi', DiskusiController::class);

    // Route tanggapan
    Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
    Route::resource('tanggapan', TanggapanController::class)->except(['show']);




});

// Route admin untuk Kelola Keluarga
Route::prefix('admin')->name('admin.')->group(function () {
    // Kelola Keluarga Pendikar
    Route::resource('keluarga', KeluargaController::class);

    // Kelola Anggota Keluarga
    Route::resource('keluarga.anggota', AnggotaController::class);

    // Statistik untuk admin
    Route::get('/statistik', [StatisticController::class, 'index'])->name('statistik');


});

Route::put('/keluarga/{keluarga}/anggota/{anggota}', [AnggotaController::class, 'update'])->name('keluarga.anggota.update');
Route::delete('/keluarga/{keluarga}/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('keluarga.anggota.destroy');

require __DIR__.'/auth.php';
