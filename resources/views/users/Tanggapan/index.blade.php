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
                        <p class="text-sm font-medium text-gray-600">Diskusi Aktif</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $tanggapan->pluck('diskusi_id')->unique()->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Tanggapan --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Semua Tanggapan</h2>
            </div>
            
            @if($tanggapan->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($tanggapan as $item)
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                {{-- Avatar --}}
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-semibold">
                                            {{ substr($item->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                
                                {{-- Content --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $item->user->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                {{ $item->created_at->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                        
                                        @if($item->user_id === auth()->id())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Tanggapan Saya
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-2">
                                        <a href="{{ route('diskusi.show', $item->diskusi->id) }}" 
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Re: {{ $item->diskusi->topik }}
                                    </a>
                                </div>
                                
                                <div class="mt-1 text-sm text-gray-600">
                                    <strong>Diskusi:</strong> {{ Str::limit($item->diskusi->isi, 100) }}
                                </div>
                                
                                <div class="mt-2">
                                    <p class="text-gray-700">{{ $item->isi }}</p>
                                </div>


                                    
                                    <div class="mt-3 flex items-center space-x-4">
                                        <a href="{{ route('diskusi.show', $item->diskusi->id) }}" 
                                           class="text-sm text-blue-600 hover:text-blue-800">
                                            Lihat Diskusi
                                        </a>
                                        
                                        @if($item->user_id === auth()->id())
                                            <span class="text-gray-300">•</span>
                                            <button class="text-sm text-red-600 hover:text-red-800">
                                                Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $tanggapan->links() }}
                </div>
            @else
                <div class="p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada tanggapan</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai diskusi dan berikan tanggapan pertama.</p>
                    <div class="mt-6">
                        <a href="{{ route('diskusi.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Lihat Diskusi
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection