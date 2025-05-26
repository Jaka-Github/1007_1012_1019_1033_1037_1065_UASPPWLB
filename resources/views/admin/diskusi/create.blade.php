@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        {{ isset($diskusi) ? 'Edit' : 'Tambah' }} Diskusi
    </h2>

    <form method="POST" 
        action="{{ isset($diskusi) ? route('diskusi.update', $diskusi->id) : route('diskusi.store') }}">
        @csrf
        @if(isset($diskusi)) @method('PUT') @endif

        {{-- Input Topik --}}
        <div class="mb-4">
            <label for="topik" class="block text-sm font-medium text-gray-700">Topik</label>
            <input type="text" id="topik" name="topik" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Masukkan topik diskusi"
                   value="{{ old('topik', $diskusi->topik ?? '') }}" required>
        </div>

        {{-- Textarea Isi --}}
        <div class="mb-4">
            <label for="isi" class="block text-sm font-medium text-gray-700">Isi</label>
            <textarea id="isi" name="isi" rows="5"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Tulis isi diskusi..." required>{{ old('isi', $diskusi->isi ?? '') }}</textarea>
        </div>

        {{-- Dropdown Agama --}}
        <div class="mb-6">
            <label for="agama_id" class="block text-sm font-medium text-gray-700">Agama</label>
            <select id="agama_id" name="agama_id" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">-- Pilih Agama --</option>
                @foreach ($agamaList as $agama)
                    <option value="{{ $agama->id }}" 
                        {{ (isset($diskusi) && $agama->id == $diskusi->agama_id) ? 'selected' : '' }}>
                        {{ $agama->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                {{ isset($diskusi) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
