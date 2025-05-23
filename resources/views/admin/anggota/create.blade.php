@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6 max-w-lg">
    <h2 class="text-2xl font-semibold mb-6">
        Tambah Anggota untuk Keluarga: <span class="text-blue-600">{{ $keluarga->nama_keluarga }}</span>
    </h2>

    <form action="{{ route('admin.keluarga.anggota.store', $keluarga->id) }}" method="POST" class="bg-white shadow rounded p-6">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block mb-1 font-medium">Nama Anggota</label>
            <input type="text" name="nama" id="nama" class="w-full border rounded px-3 py-2" required value="{{ old('nama') }}">
            @error('nama')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Akun User Terkait Jika Ada</label>
            <select name="user_id" class="form-select mt-1 block w-full">
                <option value="">-- Pilih User --</option>
                @foreach ($userList as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="umur" class="block mb-1 font-medium">Umur <span class="text-red-600">*</span></label>
            <input 
                type="number" 
                name="umur" 
                id="umur" 
                class="w-full border rounded px-3 py-2" 
                value="{{ old('umur') }}" 
                required
            >
            @error('umur')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="jenis_kelamin" class="block mb-1 font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border rounded px-3 py-2">
                <option value="" selected>Pilih jenis kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="agama_id" class="block mb-1 font-medium">Agama</label>
            <select name="agama_id" id="agama_id" class="w-full border rounded px-3 py-2" required>
                <option value="" disabled selected>Pilih Agama</option>
                @foreach($agamaList as $agama)
                    <option value="{{ $agama->id }}" {{ old('agama_id') == $agama->id ? 'selected' : '' }}>
                        {{ $agama->nama_agama }}
                    </option>
                @endforeach
            </select>
            @error('agama_id')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="alamat" class="block mb-1 font-medium">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.keluarga.anggota.index', $keluarga->id) }}" class="text-gray-600 hover:underline">&larr; Kembali</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
