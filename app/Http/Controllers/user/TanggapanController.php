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
        // Ambil semua tanggapan dan relasi terkait
        $tanggapan = Tanggapan::with(['user', 'diskusi'])->latest()->paginate(10);

        // Ambil diskusi juga jika dibutuhkan untuk daftar diskusi aktif
        $diskusi = Diskusi::with(['user', 'agama'])->latest()->paginate(10);

        return view('users.tanggapan.index', compact('tanggapan', 'diskusi'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'diskusi_id' => 'required|exists:diskusi,id',
            'isi' => 'required|string|max:1000',
        ]);

        Tanggapan::create([
            'diskusi_id' => $request->diskusi_id,
            'user_id' => $request->user()->id,
            'isi' => $request->isi,
        ]);

        return back()->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $tanggapan = Tanggapan::findOrFail($id);

        $tanggapan->update(['isi' => $request->isi]);

        return back()->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        $tanggapan->delete();

        return back()->with('success', 'Tanggapan berhasil dihapus.');
    }

}