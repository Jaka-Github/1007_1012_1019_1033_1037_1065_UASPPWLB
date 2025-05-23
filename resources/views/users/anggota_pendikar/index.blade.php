@extends('layouts.users')

@section('title', 'Daftar Anggota Keluarga')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Daftar Anggota Keluarga</h1>

    @if($anggota->isEmpty())
        <p class="text-gray-600">Belum ada anggota keluarga yang terdaftar.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-md shadow-sm">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="py-2 px-4 text-left">Nama</th>
                        <th class="py-2 px-4 text-left">Umur</th>
                        <th class="py-2 px-4 text-left">Jenis Kelamin</th>
                        <th class="py-2 px-4 text-left">Alamat</th>
                        <th class="py-2 px-4 text-left">Agama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $item->nama }}</td>
                            <td class="py-2 px-4">{{ $item->umur }}</td>
                            <td class="py-2 px-4">{{ $item->jenis_kelamin }}</td>
                            <td class="py-2 px-4">{{ $item->alamat }}</td>
                            <td class="py-2 px-4">{{ $item->agama->nama ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
