<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnggotaPendikar;
use App\Models\KeluargaPendikar;
use App\Models\Agama;
use App\Models\User;

class AnggotaController extends Controller
{
    // Tampilkan list anggota berdasarkan keluarga
    public function index(KeluargaPendikar $keluarga)
    {
        $anggota = $keluarga->anggota()->with('agama', 'user')->get(); // eager load agama dan user
        $agamaList = Agama::all();  // <== tambah ini
        $userList = User::all();

        return view('admin.anggota.index', compact('keluarga', 'anggota', 'agamaList', 'userList'));
    }
    // Form tambah anggota baru untuk keluarga tertentu
    public function create(KeluargaPendikar $keluarga)
    {
        // Ambil data agama dan user untuk dropdown
        $agamaList = Agama::all();
        $userList = User::all();

        return view('admin.anggota.create', compact('keluarga', 'agamaList', 'userList'));
    }

    // Simpan anggota baru ke keluarga tertentu
    public function store(Request $request, KeluargaPendikar $keluarga)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string|max:255',
            'users_id'=> 'nullable|exists:user,id',
            'agama_id' => 'required|exists:agama,id',
        ]);

        $anggota = new AnggotaPendikar($request->all());
        $anggota->keluarga_id = $keluarga->id;
        $anggota->save();

        return redirect()->route('admin.keluarga.anggota.index', $keluarga->id)
            ->with('success', 'Anggota berhasil ditambahkan.');
    }


    public function edit($keluarga_id, $anggota_id)
    {
        $keluarga = KeluargaPendikar::findOrFail($keluarga_id);
        $anggota = AnggotaPendikar::findOrFail($anggota_id);
        $agamaList = Agama::all();
        $userList = User::all();
        return view('admin.anggota.edit', compact('keluarga', 'anggota', 'agamaList'));
    }

    public function update(Request $request, $keluargaId, $anggotaId)
    {
        $anggota = AnggotaPendikar::where('keluarga_id', $keluargaId)->findOrFail($anggotaId);

        $anggota->update($request->only([
            'nama', 'agama_id', 'umur', 'alamat', 'jenis_kelamin', 'user_id'
        ]));

        return response()->json(['message' => 'Berhasil diupdate']);
    }

    public function destroy($keluargaId, $anggotaId)
    {
        $anggota = AnggotaPendikar::where('keluarga_id', $keluargaId)->findOrFail($anggotaId);
        $anggota->delete();

        return response()->json(['message' => 'Berhasil dihapus']);
    }


}
