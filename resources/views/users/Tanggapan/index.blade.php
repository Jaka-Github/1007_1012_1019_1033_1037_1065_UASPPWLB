@extends('layouts.users')

@section('title', 'Daftar Tanggapan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Tanggapan</h1>
            <p class="text-gray-600 mt-2">Semua tanggapan yang telah diberikan</p>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Tanggapan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $tanggapan->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Tanggapan Saya</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $tanggapan->where('user_id', auth()->id())->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-500 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Diskusi Ditanggapi</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $tanggapan->pluck('diskusi_id')->unique()->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        {{-- Daftar Diskusi dengan Tanggapan --}}
        <div class="space-y-4">
            @forelse($diskusi as $d)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-md font-bold text-gray-800 mb-1">{{ $d->topik }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $d->isi }}</p>

                    @if($d->tanggapan->count())
                        <ul class="ml-4 list-disc text-sm text-gray-700 space-y-1">
                            @foreach($d->tanggapan as $t)
                                <li>
                                    <span class="font-medium">{{ $t->user->name }}:</span> {{ $t->isi }}
                                    <span class="text-gray-400 text-xs">({{ $t->created_at->diffForHumans() }})</span>

                                    @auth
                                        @if($t->user_id === auth()->id())
                                            <div class="text-xs text-gray-500 space-x-2 mt-1">
                                                {{-- Edit --}}
                                                <button data-action="edit-tanggapan" data-id="{{ $t->id }}" data-isi="{{ $t->isi }}" class="btn-edit-tanggapan text-yellow-500 hover:underline">Edit</button>

                                                {{-- Hapus --}}
                                                <form action="{{ route('tanggapan.destroy', $t->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 italic">Belum ada tanggapan.</p>
                    @endif

                    @auth
                        <button data-action="toggle-form" data-id="{{ $d->id }}" class="btn-toggle-form text-blue-500 text-sm mt-4 hover:underline">
                            + Tambah Tanggapan
                        </button>

                        {{-- Form tambah tanggapan --}}
                        <form id="form-{{ $d->id }}" action="{{ route('tanggapan.store') }}" method="POST" class="hidden mt-2">
                            @csrf
                            <input type="hidden" name="diskusi_id" value="{{ $d->id }}">
                            <textarea name="isi" rows="2" class="w-full p-2 border rounded text-sm" placeholder="Tanggapan Anda..."></textarea>
                            <button type="submit" class="mt-1 bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600">
                                Kirim
                            </button>
                        </form>
                    @endauth
                </div>
            @empty
                <div class="p-6 text-center text-sm text-gray-500">Belum ada diskusi tersedia.</div>
            @endforelse
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {
        // Event Delegation
        document.body.addEventListener('click', function(e) {
            // Tambah Tanggapan
            if (e.target.matches('[data-action="toggle-form"]')) {
                const id = e.target.getAttribute('data-id');
                const form = document.getElementById(`form-${id}`);
                if (form) form.classList.toggle('hidden');
            }

            // Edit Tanggapan
            if (e.target.matches('[data-action="edit-tanggapan"]')) {
                const id = e.target.getAttribute('data-id');
                const isi = e.target.getAttribute('data-isi');

                // Tampilkan form popup atau inline form (contoh sederhana)
                const existingForm = document.getElementById(`edit-form-${id}`);
                if (existingForm) {
                    existingForm.classList.remove('hidden');
                    existingForm.querySelector('textarea').value = isi;
                } else {
                    const container = e.target.closest('div');
                    const form = document.createElement('form');
                    form.id = `edit-form-${id}`;
                    form.method = 'POST';
                    form.action = `/tanggapan/${id}`;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <textarea name="isi" rows="2" class="w-full p-2 border rounded text-sm">${isi}</textarea>
                        <button type="submit" class="mt-1 bg-green-500 text-white px-3 py-1 text-sm rounded hover:bg-green-600">
                            Update
                        </button>
                    `;
                    container.appendChild(form);
                }
            }
        });
    });
</script>

@endsection