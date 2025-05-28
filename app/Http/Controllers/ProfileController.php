<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Memeriksa apakah password lama yang diinputkan benar
        if ($request->has('current_password') && !Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'Password lama yang Anda masukkan salah.');
        }

        // Mengupdate data selain password
        $user->fill($request->validated());

        // Memeriksa apakah email diubah, jika iya reset status verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Jika password baru diinputkan, enkripsi password baru
        if ($request->filled('new_password')) {
            $user->password = bcrypt($request->new_password);  // Enkripsi password baru
        }

        // Simpan perubahan
        $user->save();

        // Redirect dengan status pesan
        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi password sebelum menghapus akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout pengguna
        Auth::logout();

        // Hapus akun pengguna
        $user->delete();

        // Invalidate session dan regenerate token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return Redirect::to('/');
    }
}
