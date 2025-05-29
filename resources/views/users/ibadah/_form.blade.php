
@csrf

@if (isset($isEdit) && $isEdit)
    @method('PUT')
@endif

<div class="space-y-6">
    <!-- Title Input -->
    <div class="group">
        <label for="title" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            Judul Rencana Ibadah
        </label>
        <input type="text" 
               name="title" 
               id="title"
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md @error('title') border-red-500 ring-2 ring-red-200 @enderror"
               placeholder="Contoh: Tilawah Al-Quran Pagi Hari"
               value="{{ old('title', $plan->title ?? '') }}" 
               required>
        @error('title')
            <div class="mt-2 flex items-center text-red-600 text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Category Select -->
    <div class="group">
        <label for="category" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-5v12a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2z"></path>
            </svg>
            Kategori Ibadah
        </label>
        <select name="category" 
                id="category"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md @error('category') border-red-500 ring-2 ring-red-200 @enderror"
                required>
            <option value="">Pilih Kategori Ibadah</option>
            <option value="tilawah" {{ (old('category', $plan->category ?? '') == 'tilawah') ? 'selected' : '' }} class="py-2">
                📖 Tilawah - Membaca Al-Quran
            </option>
            <option value="puasa" {{ (old('category', $plan->category ?? '') == 'puasa') ? 'selected' : '' }} class="py-2">
                🌙 Puasa - Puasa Sunnah
            </option>
            <option value="dzikir" {{ (old('category', $plan->category ?? '') == 'dzikir') ? 'selected' : '' }} class="py-2">
                🤲 Dzikir - Mengingat Allah
            </option>
            <option value="qiyamul_lail" {{ (old('category', $plan->category ?? '') == 'qiyamul_lail') ? 'selected' : '' }} class="py-2">
                🌃 Qiyamul Lail - Sholat Malam
            </option>
            <option value="infaq" {{ (old('category', $plan->category ?? '') == 'infaq') ? 'selected' : '' }} class="py-2">
                💰 Infaq - Sedekah & Donasi
            </option>
            <option value="reflection" {{ (old('category', $plan->category ?? '') == 'reflection') ? 'selected' : '' }} class="py-2">
                🤔 Reflection - Muhasabah Diri
            </option>
            <option value="dhuha" {{ (old('category', $plan->category ?? '') == 'dhuha') ? 'selected' : '' }} class="py-2">
                ☀️ Dhuha - Sholat Dhuha
            </option>
        </select>
        @error('category')
            <div class="mt-2 flex items-center text-red-600 text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Target and Duration Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Target Input -->
        <div class="group">
            <label for="target" class=" text-sm font-semibold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Target Harian
            </label>
            <div class="relative">
                <input type="number" 
                       name="target" 
                       id="target"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md @error('target') border-red-500 ring-2 ring-red-200 @enderror"
                       placeholder="Contoh: 5 halaman, 30 menit"
                       value="{{ old('target', $plan->target ?? '') }}" 
                       min="1"
                       required>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <span class="text-gray-400 text-sm">per hari</span>
                </div>
            </div>
            @error('target')
                <div class="mt-2 flex items-center text-red-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Duration Input -->
        <div class="group">
            <label for="duration" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Durasi Program
            </label>
            <div class="relative">
                <input type="number" 
                       name="duration" 
                       id="duration"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md @error('duration') border-red-500 ring-2 ring-red-200 @enderror"
                       placeholder="Contoh : 30"
                       value="{{ old('duration', $plan->duration ?? '') }}" 
                       min="1"
                       required>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <span class="text-gray-400 text-sm">hari</span>
                </div>
            </div>
            @error('duration')
                <div class="mt-2 flex items-center text-red-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Date Range Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Start Date Input -->
        <div class="group">
            <label for="start_date" class=" text-sm font-semibold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Tanggal Mulai
            </label>
            <input type="date" 
                   name="start_date" 
                   id="start_date"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md @error('start_date') border-red-500 ring-2 ring-red-200 @enderror"
                   value="{{ old('start_date', $plan->start_date ?? '') }}" 
                   required>
            @error('start_date')
                <div class="mt-2 flex items-center text-red-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- End Date Input -->
        <div class="group">
            <label for="end_date" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Tanggal Selesai
            </label>
            <input type="date" 
                   name="end_date" 
                   id="end_date"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md @error('end_date') border-red-500 ring-2 ring-red-200 @enderror"
                   value="{{ old('end_date', $plan->end_date ?? '') }}" 
                   required>
            @error('end_date')
                <div class="mt-2 flex items-center text-red-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 pt-8 mt-8 border-t border-gray-200">
    <a href="{{ route('ibadah.index') }}" 
       class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl shadow-sm hover:shadow-md hover:bg-gray-200 transition-all duration-200 border border-gray-300">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
    
    <button type="submit" 
            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transform transition-all duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            @if(isset($isEdit) && $isEdit)
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            @endif
        </svg>
        {{ isset($isEdit) && $isEdit ? 'Update Rencana' : 'Simpan Rencana' }}
    </button>
</div>

<script>
// Auto-calculate end date based on start date and duration
document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const durationInput = document.getElementById('duration');
    const endDateInput = document.getElementById('end_date');
    
    function calculateEndDate() {
        const startDate = new Date(startDateInput.value);
        const duration = parseInt(durationInput.value);
        
        if (startDate && duration && duration > 0) {
            const endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + duration - 1);
            
            // Format date to YYYY-MM-DD
            const formattedDate = endDate.toISOString().split('T')[0];
            endDateInput.value = formattedDate;
        }
    }
    
    startDateInput.addEventListener('change', calculateEndDate);
    durationInput.addEventListener('input', calculateEndDate);
});
</script>