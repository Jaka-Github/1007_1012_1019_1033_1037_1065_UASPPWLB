<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeluargaPendikar;


class KeluargaController extends Controller
{
    public function index()
    {
        $keluargas = KeluargaPendikar::withCount('anggota')->get();
        return view('admin.keluarga.index', compact('keluargas'));
    }


    public function store(Request $request)
    {
        $request->validate(['nama_keluarga' => 'required']);

        KeluargaPendikar::create($request->all());

        return back()->with('success', 'Keluarga berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $keluarga = KeluargaPendikar::findOrFail($id);
        return view('admin.keluarga.index', compact('keluarga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_keluarga' => 'required']);
        $keluarga = KeluargaPendikar::findOrFail($id);
        $keluarga->update($request->all());
        return redirect()->route('admin.keluarga.index')->with('success', 'Data keluarga diperbarui.');
    }

    public function destroy($id)
    {
        $keluarga = KeluargaPendikar::findOrFail($id);
        $keluarga->delete();
        return back()->with('success', 'Keluarga dihapus.');
    }
}
