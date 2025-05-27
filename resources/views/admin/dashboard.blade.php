@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        Dashboard Admin
    </h2>
@endsection

@section('content')
    {{-- Subtle Background Elements --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-slate-500/8 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-emerald-500/12 rounded-full blur-2xl animate-gentle-bounce"></div>
    </div>

    {{-- Section: Welcome Message --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Dynamic background overlay --}}
        <div class="absolute inset-0 overflow-hidden rounded-3xl">
            {{-- Main vibrant gradient background --}}
            <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-blue-600 to-teal-500 opacity-90 animate-gradient rounded-3xl"></div>
            
            {{-- Overlay patterns for depth --}}
            <div class="absolute inset-0 bg-gradient-to-tr from-pink-500/20 via-transparent to-yellow-400/20 rounded-3xl"></div>
            
            {{-- Floating geometric shapes --}}
            <div class="absolute top-8 left-8 w-16 h-16 bg-white/10 rounded-full blur-xl animate-float"></div>
            <div class="absolute top-12 right-12 w-12 h-12 bg-yellow-400/20 rounded-full blur-lg animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-8 left-1/4 w-20 h-20 bg-pink-500/15 rounded-full blur-2xl animate-float" style="animation-delay: -4s;"></div>
            <div class="absolute bottom-6 right-1/3 w-14 h-14 bg-blue-400/20 rounded-full blur-xl animate-float" style="animation-delay: -1s;"></div>
            
            {{-- Subtle grid pattern overlay --}}
            <div class="absolute inset-0 opacity-5 rounded-3xl">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="welcome-grid" width="30" height="30" patternUnits="userSpaceOnUse">
                            <path d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#welcome-grid)" />
                </svg>
            </div>
        </div>

        <div class="relative overflow-hidden">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-400/60 via-blue-400/60 to-teal-400/60 rounded-3xl blur-sm"></div>
            <div class="relative bg-white/20 backdrop-blur-lg border border-white/30 rounded-3xl p-8 shadow-elegant">
                <div class="flex items-center justify-between">
                    <div>
                       
                        <h3 class="text-3xl font-light mb-3 text-white drop-shadow-lg">
                            Selamat datang, 
                            <span class="bg-gradient-to-r from-yellow-200 via-pink-200 to-purple-200 bg-clip-text text-transparent font-medium">
                                {{ Auth::user()->name }}
                            </span>
                        </h3>
                        
                        <p class="text-white/90 text-lg leading-relaxed font-light mb-2">
                            Kamu login sebagai
                            <strong class="inline-flex items-center px-5 py-2 rounded-full text-sm font-semibold text-white border border-white/30 shadow-xl backdrop-blur-sm animate-gentle-pulse whitespace-nowrap ml-2">
                                👑 ADMIN
                            </strong>
                        </p>
                        
                        <p class="text-white/80 mt-3 font-light leading-relaxed">
                            Kelola platform pendikar dengan desain yang interaktif dan menawan
                        </p>
                    </div>
                    
                    {{-- decorative element --}}
                    <div class="hidden md:block">
                        <div class="relative animate-float">
                            {{-- decorative container with enhanced styling --}}
                            <div class="w-20 h-20 bg-gradient-to-br from-yellow-400/80 via-pink-500/80 to-purple-600/80 rounded-2xl flex items-center justify-center transform rotate-2 hover:rotate-3 transition-all duration-500 shadow-2xl backdrop-blur-sm border border-white/20">
                                <div class="w-16 h-16 bg-white/90 rounded-xl flex items-center justify-center shadow-elegant backdrop-blur-sm">
                                    <span class="text-2xl">⭐</span>
                                </div>
                            </div>
                            
                            {{-- floating indicators --}}
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-r from-emerald-400 to-green-500 rounded-full animate-gentle-pulse shadow-lg"></div>
                            <div class="absolute -bottom-1 -left-1 w-3 h-3 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full animate-gentle-pulse opacity-80" style="animation-delay: -1s;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section: Statistik --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: Keluarga -->
            <a href="{{ route('admin.keluarga.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-blue-200/50 to-slate-200/50 rounded-3xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm border border-slate-200/50 p-8 rounded-3xl hover:border-blue-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-elegant hover:shadow-blue">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-4 bg-gradient-to-br from-blue-100 to-slate-100 rounded-2xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-gentle-pulse"></div>
                        </div>
                    </div>
                    <h4 class="text-sm text-gray-500 uppercase mb-3 font-medium tracking-wide">Total Keluarga</h4>
                    <p class="text-4xl font-light bg-gradient-to-r from-blue-600 to-slate-700 bg-clip-text text-transparent mb-4">
                        {{ $jumlahKeluarga }}
                    </p>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-400 to-slate-500 rounded-full animate-gentle-pulse"></div>
                    </div>
                </div>
            </a>

            <!-- Card 2: Diskusi -->
            <a href="{{ route('diskusi.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-emerald-200/50 to-slate-200/50 rounded-3xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm border border-slate-200/50 p-8 rounded-3xl hover:border-emerald-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-elegant hover:shadow-emerald">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-4 bg-gradient-to-br from-emerald-100 to-slate-100 rounded-2xl">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-gentle-pulse"></div>
                        </div>
                    </div>
                    <h4 class="text-sm text-gray-500 uppercase mb-3 font-medium tracking-wide">Diskusi Aktif</h4>
                    <p class="text-4xl font-light bg-gradient-to-r from-emerald-600 to-slate-700 bg-clip-text text-transparent mb-4">
                        {{ $jumlahDiskusi }}
                    </p>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-400 to-slate-500 rounded-full animate-gentle-pulse" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Grafik --}}
        <div class="relative mt-12">
            <div class="absolute -inset-0.5 bg-gradient-to-br from-slate-200/40 via-blue-200/40 to-emerald-200/40 rounded-3xl blur-sm"></div>
            <div class="relative bg-white/85 backdrop-blur-sm border border-slate-200/60 p-8 rounded-3xl shadow-elegant">
                <div class="flex items-center justify-between mb-8">
                    <h4 class="text-2xl font-light bg-gradient-to-r from-slate-600 to-blue-600 bg-clip-text text-transparent">
                        Grafik Analitik
                    </h4>
                    <div class="flex space-x-3">
                        <div class="w-2 h-2 bg-blue-400 rounded-full animate-gentle-pulse"></div>
                        <div class="w-2 h-2 bg-slate-400 rounded-full animate-gentle-pulse" style="animation-delay: 0.3s;"></div>
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-gentle-pulse" style="animation-delay: 0.6s;"></div>
                    </div>
                </div>

                {{-- Grafik Chart --}}
                <div class="relative w-full max-w-4xl mx-auto h-[400px] p-6 bg-gradient-to-br from-slate-50/80 to-white rounded-2xl border border-slate-100">
                    <canvas id="statistikChart"
                            data-jumlah-keluarga="{{ $jumlahKeluarga ?? 0 }}"
                            data-jumlah-diskusi="{{ $jumlahDiskusi ?? 0 }}">
                    </canvas>
                </div>
            </div>
        </div>
    </section>

    {{-- Section: Aksi Cepat --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center mb-8">
            <h3 class="text-2xl font-light bg-gradient-to-r from-slate-600 to-emerald-600 bg-clip-text text-transparent mr-6">
                Aksi Cepat
            </h3>
            <div class="flex-1 h-px bg-gradient-to-r from-slate-300/50 to-transparent"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="{{ route('admin.keluarga.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-blue-200/50 to-slate-200/50 rounded-2xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="relative bg-gradient-to-br from-blue-50/80 to-slate-50/80 backdrop-blur-sm border border-slate-200/50 text-gray-700 p-8 rounded-2xl hover:border-blue-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-elegant hover:shadow-blue">
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl transform group-hover:scale-110 transition-transform duration-300">🏠</div>
                        <div>
                            <div class="font-medium text-lg text-gray-800">Kelola Keluarga</div>
                            <div class="text-blue-600 text-sm font-light">Fitur Manajemen Keluarga</div>
                        </div>
                    </div>
                    <div class="mt-6 h-1 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-400 to-slate-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 ease-out"></div>
                    </div>
                </div>
            </a>

            <a href="{{ route('diskusi.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-emerald-200/50 to-slate-200/50 rounded-2xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="relative bg-gradient-to-br from-emerald-50/80 to-slate-50/80 backdrop-blur-sm border border-slate-200/50 text-gray-700 p-8 rounded-2xl hover:border-emerald-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-elegant hover:shadow-emerald">
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl transform group-hover:scale-110 transition-transform duration-300">💬</div>
                        <div>
                            <div class="font-medium text-lg text-gray-800">Kelola Diskusi</div>
                            <div class="text-emerald-600 text-sm font-light">Fitur Diskusi Khusus Admin</div>
                        </div>
                    </div>
                    <div class="mt-6 h-1 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-400 to-slate-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 ease-out"></div>
                    </div>
                </div>
            </a>
        </div>
    </section>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 25%, #e2e8f0 50%, #f0fdfa 75%, #f8fafc 100%);
        min-height: 100vh;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-15px) rotate(180deg);
        }
    }
    
    @keyframes float-delayed {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-12px) rotate(-180deg);
        }
    }
    
    @keyframes gentle-bounce {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-8px);
        }
    }
    
    @keyframes gentle-pulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.7;
            transform: scale(1.05);
        }
    }
    
    .animate-float {
        animation: float 8s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float-delayed 10s ease-in-out infinite;
    }
    
    .animate-gentle-bounce {
        animation: gentle-bounce 5s ease-in-out infinite;
    }
    
    .animate-gentle-pulse {
        animation: gentle-pulse 3s ease-in-out infinite;
    }
    
    /* Elegant shadows */
    .shadow-elegant {
        box-shadow: 
            0 4px 6px -1px rgba(0, 0, 0, 0.04),
            0 2px 4px -1px rgba(0, 0, 0, 0.03),
            0 10px 15px -3px rgba(0, 0, 0, 0.06),
            0 20px 25px -5px rgba(0, 0, 0, 0.04);
    }
    
    .shadow-blue {
        box-shadow: 
            0 4px 6px -1px rgba(59, 130, 246, 0.08),
            0 2px 4px -1px rgba(59, 130, 246, 0.05),
            0 10px 15px -3px rgba(59, 130, 246, 0.1),
            0 20px 25px -5px rgba(59, 130, 246, 0.06);
    }
    
    .shadow-emerald {
        box-shadow: 
            0 4px 6px -1px rgba(16, 185, 129, 0.08),
            0 2px 4px -1px rgba(16, 185, 129, 0.05),
            0 10px 15px -3px rgba(16, 185, 129, 0.1),
            0 20px 25px -5px rgba(16, 185, 129, 0.06);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(248, 250, 252, 0.8);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #64748b, #3b82f6);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #475569, #2563eb);
    }
    
    /* Smooth transitions for all elements */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Refined typography */
    h1, h2, h3, h4, h5, h6 {
        letter-spacing: -0.025em;
    }
    
    /* Subtle backdrop effects */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Universal Aesthetic Dashboard loaded');
        
        // Test apakah function handleLogout tersedia
        if (typeof handleLogout === 'function') {
            console.log('handleLogout function is available');
        } else {
            console.error('handleLogout function is NOT available');
        }
        
        // Script untuk quick actions
        const quickActions = document.querySelectorAll('a[href="#"]');
        quickActions.forEach(action => {
            action.addEventListener('click', function(e) {
                e.preventDefault();
                const actionName = this.textContent.trim();
                
                // Clean notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-white/90 backdrop-blur-sm border border-slate-200 text-gray-700 px-6 py-4 rounded-2xl shadow-elegant z-50 transform translate-x-full transition-all duration-500';
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-gentle-pulse"></div>
                        <span class="font-medium">Navigating to: ${actionName}</span>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);
                
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 500);
                }, 3000);
            });
        });

        // Initialize Chart
        initializeChart();
    });

    function initializeChart() {
        const canvas = document.getElementById('statistikChart');
        
        if (!canvas) {
            console.error('Canvas element not found');
            return;
        }

        const jumlahKeluarga = parseInt(canvas.dataset.jumlahKeluarga || '0', 10);
        const jumlahDiskusi = parseInt(canvas.dataset.jumlahDiskusi || '0', 10);
        const ctx = canvas.getContext('2d');
        
        if (!ctx) {
            console.error('Cannot get 2D context from canvas');
            return;
        }

        // Destroy existing chart if it exists
        if (window.statistikChart instanceof Chart) {
            window.statistikChart.destroy();
        }

        // Data dari backend - pastikan ada fallback jika undefined

        console.log('Chart data:', { jumlahKeluarga, jumlahDiskusi });

        try {
            window.statistikChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Keluarga', 'Diskusi'],
                    datasets: [{
                        label: 'Count',
                        data: [jumlahKeluarga, jumlahDiskusi],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)'
                        ],
                        borderWidth: 2,
                        borderRadius: 12,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Statistik Dashboard',
                            color: '#475569',
                            font: {
                                size: 18,
                                weight: 'normal',
                                family: 'system-ui'
                            },
                            padding: {
                                bottom: 30
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#64748b',
                                font: {
                                    size: 14,
                                    family: 'system-ui'
                                }
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.2)',
                                borderColor: 'rgba(148, 163, 184, 0.3)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#64748b',
                                font: {
                                    size: 14,
                                    family: 'system-ui'
                                }
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.2)',
                                borderColor: 'rgba(148, 163, 184, 0.3)'
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutCubic'
                    },
                    elements: {
                        bar: {
                            borderRadius: 12,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            console.log('Universal Chart initialized successfully');
        } catch (error) {
            console.error('Error initializing chart:', error);
        }
    }

    // Fallback jika DOM sudah ready
    if (document.readyState === 'complete') {
        initializeChart();
    }
</script>
@endpush