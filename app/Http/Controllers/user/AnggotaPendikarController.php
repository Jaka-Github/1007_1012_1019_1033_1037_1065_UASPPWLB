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
        $anggota = AnggotaPendikar::with('agama')->get();

        return view('users.anggota_pendikar.index', compact('anggota'));
    }

}
