@extends('layouts.admin')

@section('title', 'Keluarga Pendikar')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        CRUD Keluarga Pendikar 
    </h2>
@endsection

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    {{-- Form Tambah Keluarga --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Tambah Keluarga</h3>
        <form action="{{ route('admin.keluarga.store') }}" method="POST">
            @csrf
            <div class="flex items-center space-x-4">
                <input type="text" name="nama_keluarga" placeholder="Nama Keluarga" class="border border-gray-300 rounded px-4 py-2 w-full" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
            </div>
        </form>
    </div>

{{-- Daftar Keluarga --}}
<div class="grid md:grid-cols-3 gap-6 pb-8">
    @foreach($keluargas as $keluarga)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 transition duration-300 ease-in-out transform hover:scale-[1.02] hover:shadow-lg hover:border-blue-200">
        <h4 class="text-xl font-semibold text-gray-800 mb-4">{{ $keluarga->nama_keluarga }}</h4>

        <div class="flex justify-between items-center flex-wrap gap-3">
            {{-- Tombol Hapus --}}
            <form action="{{ route('admin.keluarga.destroy', $keluarga->id) }}" method="POST" class="flex items-center">
                @csrf
                @method('DELETE')
                <button 
                    class="flex items-center text-red-600 hover:underline"
                    onclick="return confirm('Hapus keluarga ini?')"
                    type="submit"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                    </svg>
                    Hapus
                </button>
            </form>

            {{-- Tombol Edit --}}
            <a href="{{ route('admin.keluarga.edit', $keluarga->id) }}" class="flex items-center text-yellow-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2m-1 1v2m-1 1v2m-1 1v2m1-7l7 7m-4-4l4 4" />
                </svg>
                Edit
            </a>

            {{-- Tombol Kelola Anggota --}}
            <a href="{{ route('admin.keluarga.anggota.index', $keluarga->id) }}" class="flex items-center text-blue-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Kelola Anggota
            </a>
        </div>
    </div>
    @endforeach
</div>

</div>
@endsection