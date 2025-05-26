@extends('layouts.admin') {{-- Pastikan layout ini juga mendukung Tailwind --}}

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md mt-10">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Diskusi</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('diskusi.update', $diskusi->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Topik --}}
        <div>
            <label for="topik" class="block text-gray-700 font-medium mb-1">Topik</label>
            <input type="text" name="topik" id="topik" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400"
                   value="{{ old('topik', $diskusi->topik) }}">
        </div>

        {{-- Isi --}}
        <div>
            <label for="isi" class="block text-gray-700 font-medium mb-1">Isi Diskusi</label>
            <textarea name="isi" id="isi" rows="5" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">{{ old('isi', $diskusi->isi) }}</textarea>
        </div>

        {{-- Agama --}}
        <div>
            <label for="agama_id" class="block text-gray-700 font-medium mb-1">Agama</label>
            <select name="agama_id" id="agama_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring focus:border-blue-400">
                <option value="">-- Pilih Agama --</option>
                @foreach ($agamaList as $agama)
                    <option value="{{ $agama->id }}" {{ $agama->id == $diskusi->agama_id ? 'selected' : '' }}>
                        {{ $agama->nama_agama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
                Simpan Perubahan
            </button>
            <a href="{{ route('diskusi.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition duration-200">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
