<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Diskusi;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    /**
     * Menampilkan daftar semua tanggapan
     */
    public function index()
    {
        $tanggapan = Tanggapan::with(['user', 'diskusi'])
            ->latest()
            ->paginate(10);
            
        return view('users.tanggapan.index', compact('tanggapan'));
    }

    /**
     * Menampilkan form untuk membuat tanggapan baru
     */
    public function create($diskusi_id)
    {
        $diskusi = Diskusi::with(['user', 'tanggapan.user'])->findOrFail($diskusi_id);
        return view('tanggapan.create', compact('diskusi'));
    }

    /**
     * Menyimpan tanggapan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'diskusi_id' => 'required|exists:diskusi,id',
            'isi' => 'required|string|max:1000',
        ]);

        Tanggapan::create([
            'diskusi_id' => $request->diskusi_id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim.');
    }
}