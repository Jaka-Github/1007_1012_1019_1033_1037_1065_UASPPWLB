@extends('layouts.admin')



@section('content')
<div>
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Forum Diskusi</h1>
                    <p class="text-gray-600">Bergabunglah dalam diskusi antaragama pendikar!</p>
                </div>
                <a href="{{ route('admin.diskusi.create') }}"
                   class="group bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Mulai Diskusi Baru
                </a>
            </div>
        </div>

        <!-- Discussions Grid -->
        <div class="grid gap-6 md:gap-8">
            @foreach ($diskusi as $d)
                <div class="group bg-white/80 backdrop-blur-sm shadow-lg hover:shadow-2xl rounded-2xl p-6 md:p-8 border border-gray-100 hover:border-blue-200 transition-all duration-500 transform hover:-translate-y-1">
                    <!-- Discussion Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-4">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <h3 class="text-xl md:text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $d->topik }}
                                </h3>
                                <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    {{ $d->agama->nama_agama }}
                                </span>
                            </div>
                            
                            <!-- Author Info -->
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                    {{ strtoupper(substr($d->user->name, 0, 1)) }}
                                </div>
                                <span>Oleh <strong class="text-gray-700">{{ $d->user->name }}</strong></span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span>{{ $d->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Discussion Content -->
                    <div class="mb-6">
                        <p class="text-gray-700 leading-relaxed text-base md:text-lg line-clamp-3">
                            {{ $d->isi }}
                        </p>
                        
                        <!-- Preview Button -->
                        <button 
                            data-open-modal="{{ $d->id }}" 
                            class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors duration-200"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Isi
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                        
                        <a href="{{ route('admin.diskusi.edit', $d->id) }}"
                           class="flex items-center gap-2 bg-amber-50 hover:bg-amber-100 text-amber-600 px-4 py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>

                        <form action="{{ route('admin.diskusi.destroy', $d->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus diskusi ini? Tindakan ini tidak dapat dibatalkan.')"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Preview Modal for each discussion -->
                <div id="previewModal{{ $d->id }}" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-70 flex items-center justify-center p-4" data-modal-backdrop="{{ $d->id }}">>
                    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[80vh] overflow-hidden mx-auto" data-modal-content="{{ $d->id }}">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
                            <h3 class="text-lg font-semibold text-gray-800">Detail Isi</h3>
                            <button data-close-modal="{{ $d->id }}" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Modal Body - Content Only -->
                        <div class="p-6 max-h-[calc(80vh-120px)] overflow-y-auto">
                            <div class="prose prose-lg max-w-none">
                                <p class="text-gray-700 leading-relaxed text-base whitespace-pre-wrap">{{ $d->isi }}</p>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="flex justify-end gap-3 p-4 border-t border-gray-200 bg-gray-50">
                            <button data-close-modal="{{ $d->id }}" 
                                    class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if ($diskusi->isEmpty())
            <div class="text-center py-16">
                <div class="mb-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-600 mb-2">Belum ada diskusi</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        Mulai percakapan yang bermakna dengan komunitas pendikar. Bagikan pemikiran, ajukan pertanyaan, atau diskusikan topik yang menarik.
                    </p>
                    <a href="{{ route('admin.diskusi.create') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Mulai Diskusi Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Custom gradient animations */
@keyframes gradient-shift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}

/* Modal animations */
.modal-enter {
    opacity: 0;
    transform: scale(0.9);
}

.modal-enter-active {
    opacity: 1;
    transform: scale(1);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.modal-exit {
    opacity: 1;
    transform: scale(1);
}

.modal-exit-active {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.3s ease, transform 0.3s ease;
}
</style>

<script>
    // Event delegation untuk semua modal actions
    document.addEventListener('click', function(event) {
        const target = event.target.closest('[data-open-modal]') || 
                      event.target.closest('[data-close-modal]') || 
                      event.target.closest('[data-modal-backdrop]');
        
        if (target) {
            // Open modal
            if (target.dataset.openModal) {
                openPreviewModal(target.dataset.openModal);
            }
            
            // Close modal
            if (target.dataset.closeModal) {
                closePreviewModal(target.dataset.closeModal);
            }
            
            // Close modal by clicking backdrop
            if (target.dataset.modalBackdrop && !event.target.closest('[data-modal-content]')) {
                closePreviewModal(target.dataset.modalBackdrop);
            }
        }
    });

    function openPreviewModal(id) {
        const modal = document.getElementById('previewModal' + id);
        modal.classList.remove('hidden');
        
        // Add animation class
        const modalContent = modal.querySelector('[data-modal-content]');
        modalContent.classList.add('modal-enter');
        
        setTimeout(() => {
            modalContent.classList.remove('modal-enter');
            modalContent.classList.add('modal-enter-active');
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closePreviewModal(id) {
        const modal = document.getElementById('previewModal' + id);
        const modalContent = modal.querySelector('[data-modal-content]');
        
        modalContent.classList.add('modal-exit-active');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modalContent.classList.remove('modal-enter-active', 'modal-exit-active');
            
            // Restore body scroll
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            // Find and close any open modal
            const openModals = document.querySelectorAll('[id^="previewModal"]:not(.hidden)');
            openModals.forEach(modal => {
                const modalId = modal.id.replace('previewModal', '');
                closePreviewModal(modalId);
            });
        }
    });
</script>
@endsection