<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\admin\AnggotaController;
use App\Http\Controllers\admin\KeluargaController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\User\AnggotaPendikarController;

Route::get('/', function () {
    return redirect()->route('register');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.statistik');
        } else {
            return view('users.dashboard');
        }
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('keluarga', KeluargaController::class);
        Route::resource('keluarga.anggota', AnggotaController::class);
        Route::get('/statistik', [StatisticController::class, 'index'])->name('statistik');


});

//route untuk lihat anggota keluarga
Route::middleware(['auth'])->group(function () {
    Route::get('/anggota-keluarga', [AnggotaPendikarController::class, 'index'])->name('anggota.index');
});

Route::put('/admin/keluarga/{keluarga}/anggota/{anggota}', [AnggotaController::class, 'update']);
Route::delete('/admin/keluarga/{keluarga}/anggota/{anggota}', [AnggotaController::class, 'destroy']);

require __DIR__.'/auth.php';





