@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Diskusi</h2>
        <a href="{{ route('diskusi.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Diskusi
        </a>
    </div>

    @foreach ($diskusi as $d)
        <div class="bg-white shadow-md rounded-lg p-6 mb-4 border border-gray-200">
            <h4 class="text-xl font-bold text-gray-700">
                {{ $d->topik }}
                <span class="text-sm text-gray-500">({{ $d->agama->nama_agama }})</span>
            </h4>
            <p class="text-gray-600 mt-2">{{ $d->isi }}</p>
            <small class="text-sm text-gray-500 block mt-2">Oleh: {{ $d->user->name }}</small>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('diskusi.edit', $d->id) }}"
                   class="text-sm bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                    Edit
                </a>

                <form action="{{ route('diskusi.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    @endforeach

    @if ($diskusi->isEmpty())
        <p class="text-gray-500 text-center">Belum ada diskusi.</p>
    @endif
</div>
@endsection
