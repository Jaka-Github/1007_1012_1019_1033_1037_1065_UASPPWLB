@extends('layouts.users')

@section('title', 'Beri Tanggapan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6">
            <a href="{{ route('diskusi.show', $diskusi->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Diskusi
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Beri Tanggapan</h1>
        </div>

        {{-- Tampilkan Diskusi yang akan ditanggapi --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Diskusi:</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $diskusi->judul }}</h3>
                <p class="text-gray-600 mb-3">{{ $diskusi->deskripsi }}</p>
                <div class="flex items-center text-sm text-gray-500">
                    <span class="mr-4">
                        <i class="fas fa-user mr-1"></i>
                        {{ $diskusi->user->name }}
                    </span>
                    <span>
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $diskusi->created_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Form Tanggapan --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tulis Tanggapan Anda</h2>
            
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

            {{-- Alert Error --}}
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('tanggapan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="diskusi_id" value="{{ $diskusi->id }}">
                
                <div class="mb-4">
                    <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggapan Anda <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="isi" 
                        id="isi" 
                        rows="6" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('isi') border-red-500 @enderror" 
                        placeholder="Tulis tanggapan Anda disini..."
                        required>{{ old('isi') }}</textarea>
                    
                    @error('isi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <p class="mt-1 text-sm text-gray-500">
                        Maksimal 1000 karakter. Sisa: <span id="charCount">1000</span>
                    </p>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-1"></i>
                        Tanggapan akan dikirim sebagai <strong>{{ Auth::user()->name }}</strong>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('diskusi.show', $diskusi->id) }}" 
                           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Tanggapan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tanggapan Sebelumnya (Opsional) --}}
        @if($diskusi->tanggapan->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Tanggapan Sebelumnya ({{ $diskusi->tanggapan->count() }})
                </h3>
                
                <div class="space-y-4">
                    @foreach($diskusi->tanggapan->sortByDesc('created_at') as $tanggapan)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm font-semibold">
                                            {{ substr($tanggapan->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $tanggapan->user->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $tanggapan->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700 ml-11">{{ $tanggapan->isi }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

{{-- JavaScript untuk character counter --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('isi');
    const charCount = document.getElementById('charCount');
    const maxLength = 1000;

    function updateCharCount() {
        const remaining = maxLength - textarea.value.length;
        charCount.textContent = remaining;
        
        if (remaining < 50) {
            charCount.classList.add('text-red-500');
        } else {
            charCount.classList.remove('text-red-500');
        }
    }

    textarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count
});
</script>
@endsection