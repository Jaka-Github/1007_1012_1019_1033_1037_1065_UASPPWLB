@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-8">
    <div class="max-w-3xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                {{ isset($diskusi) ? 'Edit Diskusi' : 'Mulai Diskusi Baru' }}
            </h1>
            <p class="text-gray-600">
                {{ isset($diskusi) ? 'Perbarui diskusi Anda' : 'Bagikan pemikiran dan mulai percakapan yang bermakna' }}
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl p-8 border border-gray-100">
            <form method="POST" 
                action="{{ isset($diskusi) ? route('admin.diskusi.update', $diskusi->id) : route('admin.diskusi.store') }}"
                class="space-y-6">
                @csrf
                @if(isset($diskusi)) @method('PUT') @endif

                <!-- Topik Input -->
                <div class="group">
                    <label for="topik" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Topik Diskusi
                    </label>
                    <input type="text" id="topik" name="topik" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                           placeholder="Berikan topik yang anda pikirkan."
                           value="{{ old('topik', $diskusi->topik ?? '') }}" required>
                    @error('topik')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Kategori Agama -->
                <div class="group">
                    <label for="agama_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Kategori Agama
                    </label>
                    <select id="agama_id" name="agama_id" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-300 bg-white"
                            required>
                        <option value="" class="text-gray-400">Pilih kategori agama...</option>
                        @foreach ($agamaList as $agama)
                            <option value="{{ $agama->id }}" 
                                {{ (old('agama_id', $diskusi->agama_id ?? '') == $agama->id) ? 'selected' : '' }}>
                                {{ $agama->nama_agama }}
                            </option>
                        @endforeach
                    </select>
                    @error('agama_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Isi Diskusi -->
                <div class="group">
                    <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Isi Diskusi
                    </label>
                    <textarea id="isi" name="isi" rows="6"
                              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-100 focus:border-green-500 transition-all duration-300 placeholder-gray-400 resize-none"
                              placeholder="Tulis pemikiran, pertanyaan, atau topik yang ingin Anda diskusikan. Jelaskan dengan detail agar diskusi menjadi lebih bermakna..."
                              required>{{ old('isi', $diskusi->isi ?? '') }}</textarea>
                    <div class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Minimal 20 karakter untuk diskusi yang bermakna
                    </div>
                    @error('isi')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.diskusi.index') }}"
                       class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </a>
                    
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        @if(isset($diskusi))
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Perbarui Diskusi
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Publikasikan Diskusi
                        @endif
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                Tips untuk diskusi yang baik:
            </h3>
            <ul class="text-sm text-blue-700 space-y-1">
                <li class="flex items-start gap-2">
                    <span class="text-blue-500 mt-1">•</span>
                    Gunakan judul yang jelas dan menarik
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-500 mt-1">•</span>
                    Jelaskan konteks dan latar belakang topik
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-500 mt-1">•</span>
                    Hormati sudut pandang yang berbeda
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
/* Custom focus states */
.group:focus-within label {
    color: #3b82f6;
}

/* Character counter animation */
textarea:focus + .character-hint {
    opacity: 1;
    transform: translateY(0);
}

.character-hint {
    opacity: 0.7;
    transform: translateY(-2px);
    transition: all 0.2s ease;
}

/* Form validation styles */
input:invalid:not(:focus):not(:placeholder-shown),
textarea:invalid:not(:focus):not(:placeholder-shown),
select:invalid:not(:focus) {
    border-color: #ef4444;
    background-color: #fef2f2;
}

input:valid:not(:focus):not(:placeholder-shown),
textarea:valid:not(:focus):not(:placeholder-shown),
select:valid:not(:focus) {
    border-color: #10b981;
    background-color: #f0fdf4;
}

/* Smooth animations */
* {
    transition-property: color, background-color, border-color, transform, box-shadow;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endsection