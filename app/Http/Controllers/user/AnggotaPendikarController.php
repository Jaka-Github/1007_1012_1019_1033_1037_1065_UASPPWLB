<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnggotaPendikar;
use Illuminate\Support\Facades\Auth;

class AnggotaPendikarController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $anggota = AnggotaPendikar::with('agama') // eager load relasi agama
            ->where('user_id', $user->id)
            ->get();


        return view('users.anggota_pendikar.index', compact('anggota'));
    }
}
