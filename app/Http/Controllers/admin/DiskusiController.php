<?php

// app/Http/Controllers/Admin/DiskusiController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskusi;
use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiskusiController extends Controller
{
    public function index()
    {
        $diskusi = Diskusi::with(['user', 'agama'])->get();
        return view('admin.diskusi.index', compact('diskusi'));
    }

    public function create()
    {
        $agamaList = Agama::all();
        return view('admin.diskusi.create', compact('agamaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topik' => 'required|string|max:255',
            'isi' => 'required|string',
            'agama_id' => 'required|exists:agama,id',
        ]);

        Diskusi::create([
            'topik' => $request->topik,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
            'agama_id' => $request->agama_id,
        ]);

        return redirect()->route('diskusi.index')->with('success', 'Diskusi berhasil dibuat.');
    }

    public function show($id)
    {
        $diskusi = Diskusi::with(['user', 'tanggapan.user'])->findOrFail($id);
        return view('admin.diskusi.show', compact('diskusi'));
    }

    public function edit($id)
    {
        $diskusi = Diskusi::findOrFail($id);
        $agamaList = Agama::all();

        return view('admin.diskusi.edit', compact('diskusi', 'agamaList'));
    }

    public function update(Request $request, Diskusi $diskusi)
    {
        $request->validate([
            'topik' => 'required|string|max:255',
            'isi' => 'required|string',
            'agama_id' => 'required|exists:agama,id',
        ]);

        $diskusi->update($request->only('topik', 'isi', 'agama_id'));

        return redirect()->route('diskusi.index')->with('success', 'Diskusi berhasil diperbarui.');
    }

    public function destroy(Diskusi $diskusi)
    {
        $diskusi->delete();
        return redirect()->route('diskusi.index')->with('success', 'Diskusi berhasil dihapus.');
    }
}
