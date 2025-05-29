<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\admin\AnggotaController;
use App\Http\Controllers\admin\KeluargaController;
use App\Http\Controllers\admin\StatisticController;
use App\Http\Controllers\user\AnggotaPendikarController;
use App\Http\Controllers\admin\DiskusiController;
use App\Http\Controllers\user\TanggapanController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\admin\IbadahTrackerController; // ✅ Admin (mentor)
use App\Http\Controllers\user\IbadahController;          // ✅ User (mahasiswa)

Route::get('/', function () {
    return redirect()->route('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : app(DashboardController::class)->index();
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Anggota pendikar
    Route::get('/anggota-keluarga', [AnggotaPendikarController::class, 'index'])->name('anggota.index');

    // Tanggapan
    Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
    Route::resource('tanggapan', TanggapanController::class)->except(['show']);

    // ✅ Route Ibadah Mahasiswa (IbadahController)
    Route::prefix('ibadah')->name('ibadah.')->group(function () {
        Route::get('/', [IbadahController::class, 'index'])->name('index');
        Route::get('/create', [IbadahController::class, 'create'])->name('create');
        Route::post('/', [IbadahController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [IbadahController::class, 'edit'])->name('edit');
        Route::put('/{id}', [IbadahController::class, 'update'])->name('update');
        Route::delete('/{id}', [IbadahController::class, 'destroy'])->name('destroy');

        // Log Ibadah
        Route::post('/{id}/log', [IbadahController::class, 'logIbadah'])->name('log'); // Update status harian
        Route::get('/progress', [IbadahController::class, 'progress'])->name('progress'); // View dashboard kemajuan
        Route::delete('/log/{id}', [IbadahController::class, 'deleteLog'])->name('log.destroy');


    });
});

// ✅ Route admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Keluarga Pendikar
    Route::resource('keluarga', KeluargaController::class);

    // Anggota Keluarga
    Route::resource('keluarga.anggota', AnggotaController::class);

    // Diskusi
    Route::resource('diskusi', DiskusiController::class);

    // Statistik
    Route::get('/dashboard', [StatisticController::class, 'index'])->name('dashboard');

    // ✅ Ibadah Tracker untuk mentor/admin
    Route::get('/ibadah-tracker', [IbadahTrackerController::class, 'index'])->name('ibadah.index');
    Route::get('/ibadah-tracker/create', [IbadahTrackerController::class, 'create'])->name('ibadah.create');
    Route::post('/ibadah-tracker', [IbadahTrackerController::class, 'store'])->name('ibadah.store');
    Route::get('/ibadah-tracker/{id}/edit', [IbadahTrackerController::class, 'edit'])->name('ibadah.edit');
    Route::put('/ibadah-tracker/{id}', [IbadahTrackerController::class, 'update'])->name('ibadah.update');
    Route::delete('/ibadah-tracker/{id}', [IbadahTrackerController::class, 'destroy'])->name('ibadah.destroy');

    // (Optional) Lihat Log Ibadah per user
    Route::get('/ibadah-tracker/{id}/logs', [IbadahTrackerController::class, 'showLogs'])->name('ibadah.logs');
});

require __DIR__.'/auth.php';
