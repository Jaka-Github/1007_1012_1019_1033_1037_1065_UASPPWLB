@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6 max-w-2xl"> {{-- Increased max-width for better layout --}}
    <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center"> {{-- Larger, bolder title, centered --}}
        Tambah Anggota untuk Keluarga: 
        <p>
        <br>
        <span class="text-blue-600 flex items-center justify-center gap-2"> {{-- Added flex and items-center for icon alignment --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-blue-500"> {{-- Family icon SVG --}}
                <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5zm0 8c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm-7 11c0-.552-.447-1-1-1H3c-.553 0-1 .448-1 1v2c0 .552.447 1 1 1h2c.553 0 1-.448 1-1v-2zm16 0c0-.552-.447-1-1-1h-2c-.553 0-1 .448-1 1v2c0 .552.447 1 1 1h2c.553 0 1-.448 1-1v-2zM12 14c-3.86 0-7 3.14-7 7v3h14v-3c0-3.86-3.14-7-7-7zm-5 7c0-2.757 2.243-5 5-5s5 2.243 5 5v1H7v-1z"/>
            </svg>
            {{ $keluarga->nama_keluarga }}
        </span>
    </h2>

    <form action="{{ route('admin.keluarga.anggota.store', $keluarga->id) }}" method="POST" class="bg-white shadow-xl rounded-xl p-8 border border-gray-200"> {{-- More prominent shadow, rounded corners, subtle border --}}
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> {{-- Grid layout for better organization on larger screens --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Anggota <span class="text-red-600">*</span></label>
                <input type="text" name="nama" id="nama" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" required value="{{ old('nama') }}" placeholder="Masukkan nama anggota">
                @error('nama')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Akun User Terkait Jika Ada</label>
                <select name="user_id" class="form-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out">
                    <option value="">-- Pilih User --</option>
                    @foreach ($userList as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 text-sm font-bold mb-2">Umur (Tahun) <span class="text-red-600">*</span></label>
                <input
                    type="number"
                    name="umur"
                    id="umur"
                    class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                    value="{{ old('umur') }}"
                    required
                    placeholder="Masukkan umur"
                    min="0" {{-- Added min attribute for age --}}
                >
                @error('umur')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin <span class="text-red-600">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" required>
                    <option value="" selected disabled>Pilih jenis kelamin</option> {{-- Added disabled to prevent selection --}}
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-6"> {{-- Increased bottom margin for this section --}}
            <label for="agama_id" class="block text-gray-700 text-sm font-bold mb-2">Agama <span class="text-red-600">*</span></label>
            <select name="agama_id" id="agama_id" class="form-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" required>
                <option value="" disabled selected>Pilih Agama</option>
                @foreach($agamaList as $agama)
                    <option value="{{ $agama->id }}" {{ old('agama_id') == $agama->id ? 'selected' : '' }}>
                        {{ $agama->nama_agama }}
                    </option>
                @endforeach
            </select>
            @error('agama_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat <span class="text-red-600">*</span></label>
            <textarea name="alamat" id="alamat" rows="4" class="form-textarea w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" required placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-between items-center mt-8"> {{-- Increased top margin for buttons --}}
            <a href="{{ route('admin.keluarga.anggota.index', $keluarga->id) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-200 group">
                <svg class="w-5 h-5 mr-2 text-gray-600 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>

            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 group">
                <svg class="w-5 h-5 mr-2 text-white group-hover:scale-110 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection
