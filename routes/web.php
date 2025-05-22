<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return view('admin.dashboard');
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

require __DIR__.'/auth.php';





