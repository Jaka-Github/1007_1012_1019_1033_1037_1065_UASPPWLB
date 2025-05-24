@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-2xl text-amber-900 leading-tight">
        Dashboard Admin
    </h2>
@endsection

@section('content')
    {{-- Subtle Background Elements --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-amber-600/8 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-stone-600/6 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-orange-600/10 rounded-full blur-2xl animate-gentle-bounce"></div>
    </div>

    {{-- Section: Welcome Message --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="relative overflow-hidden">
            <!-- Earth gradient background -->
            <div class="absolute inset-0 bg-gradient-to-br from-stone-50 via-amber-50 to-orange-50 rounded-3xl"></div>
            
            <!-- Minimal border glow -->
            <div class="absolute -inset-0.5 bg-gradient-to-r from-amber-200/40 via-stone-200/40 to-orange-200/40 rounded-3xl blur-sm"></div>
            
            <!-- Content -->
            <div class="relative bg-white/90 backdrop-blur-sm border border-stone-200/60 rounded-3xl p-8 shadow-earth">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-light mb-3 bg-gradient-to-r from-amber-800 to-stone-700 bg-clip-text text-transparent">
                            Welcome back, {{ Auth::user()->name }}
                        </h3>
                        <p class="text-stone-600 text-lg leading-relaxed font-light">
                            You're logged in as 
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-gradient-to-r from-amber-100 to-stone-100 text-amber-800 ml-2 border border-amber-200/50">
                                ADMIN
                            </span>
                        </p>
                        <p class="text-stone-500 mt-3 font-light">
                            Manage your platform with this natural and intuitive interface
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-amber-200 to-orange-300 rounded-2xl flex items-center justify-center transform rotate-2 hover:rotate-3 transition-transform duration-500">
                                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-earth">
                                    <span class="text-2xl">🌍</span>
                                </div>
                            </div>
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-orange-500 rounded-full animate-gentle-pulse"></div>
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
                <div class="absolute -inset-0.5 bg-gradient-to-br from-amber-200/50 to-stone-200/50 rounded-3xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm border border-stone-200/50 p-8 rounded-3xl hover:border-amber-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-earth hover:shadow-amber">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-4 bg-gradient-to-br from-amber-100 to-stone-100 rounded-2xl">
                            <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="w-2 h-2 bg-amber-600 rounded-full animate-gentle-pulse"></div>
                        </div>
                    </div>
                    <h4 class="text-sm text-stone-500 uppercase mb-3 font-medium tracking-wide">Total Keluarga</h4>
                    <p class="text-4xl font-light bg-gradient-to-r from-amber-700 to-stone-700 bg-clip-text text-transparent mb-4">
                        {{ $jumlahKeluarga }}
                    </p>
                    <div class="h-1.5 bg-stone-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-amber-500 to-stone-600 rounded-full animate-gentle-pulse"></div>
                    </div>
                </div>
            </a>

            <!-- Card 2: Diskusi -->
            <a href="#" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-orange-200/50 to-stone-200/50 rounded-3xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm border border-stone-200/50 p-8 rounded-3xl hover:border-orange-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-earth hover:shadow-orange">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-4 bg-gradient-to-br from-orange-100 to-stone-100 rounded-2xl">
                            <svg class="w-8 h-8 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="w-2 h-2 bg-orange-600 rounded-full animate-gentle-pulse"></div>
                        </div>
                    </div>
                    <h4 class="text-sm text-stone-500 uppercase mb-3 font-medium tracking-wide">Diskusi Aktif</h4>
                    <p class="text-4xl font-light bg-gradient-to-r from-orange-700 to-stone-700 bg-clip-text text-transparent mb-4">
                        {{ $jumlahDiskusi }}
                    </p>
                    <div class="h-1.5 bg-stone-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-orange-500 to-stone-600 rounded-full animate-gentle-pulse" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </a>

            <!-- Card 3: Additional Earth Element -->
            <div class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-yellow-200/50 to-stone-200/50 rounded-3xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="relative bg-white/90 backdrop-blur-sm border border-stone-200/50 p-8 rounded-3xl hover:border-yellow-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-earth hover:shadow-yellow">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-4 bg-gradient-to-br from-yellow-100 to-stone-100 rounded-2xl">
                            <svg class="w-8 h-8 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="w-2 h-2 bg-yellow-600 rounded-full animate-gentle-pulse"></div>
                        </div>
                    </div>
                    <h4 class="text-sm text-stone-500 uppercase mb-3 font-medium tracking-wide">System Status</h4>
                    <p class="text-4xl font-light bg-gradient-to-r from-yellow-700 to-stone-700 bg-clip-text text-transparent mb-4">
                        Active
                    </p>
                    <div class="h-1.5 bg-stone-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-yellow-500 to-stone-600 rounded-full animate-gentle-pulse" style="animation-delay: 2s;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik --}}
        <div class="relative mt-12">
            <div class="absolute -inset-0.5 bg-gradient-to-br from-amber-200/40 via-stone-200/40 to-orange-200/40 rounded-3xl blur-sm"></div>
            <div class="relative bg-white/90 backdrop-blur-sm border border-stone-200/60 p-8 rounded-3xl shadow-earth">
                <div class="flex items-center justify-between mb-8">
                    <h4 class="text-2xl font-light bg-gradient-to-r from-amber-800 to-stone-700 bg-clip-text text-transparent">
                        Analytics Overview
                    </h4>
                    <div class="flex space-x-3">
                        <div class="w-2 h-2 bg-amber-500 rounded-full animate-gentle-pulse"></div>
                        <div class="w-2 h-2 bg-stone-500 rounded-full animate-gentle-pulse" style="animation-delay: 0.3s;"></div>
                        <div class="w-2 h-2 bg-orange-500 rounded-full animate-gentle-pulse" style="animation-delay: 0.6s;"></div>
                    </div>
                </div>
                <div class="relative w-full max-w-4xl mx-auto h-[400px] p-6 bg-gradient-to-br from-stone-50/80 to-amber-50/60 rounded-2xl border border-stone-100">
                    <canvas id="statistikChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    {{-- Section: Quick Actions --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex items-center mb-8">
            <h3 class="text-2xl font-light bg-gradient-to-r from-amber-800 to-orange-700 bg-clip-text text-transparent mr-6">
                Actions
            </h3>
            <div class="flex-1 h-px bg-gradient-to-r from-stone-300/50 to-transparent"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="{{ route('admin.keluarga.index') }}" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-amber-200/50 to-stone-200/50 rounded-2xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="relative bg-gradient-to-br from-amber-50/80 to-stone-50/80 backdrop-blur-sm border border-stone-200/50 text-stone-700 p-8 rounded-2xl hover:border-amber-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-earth hover:shadow-amber">
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl transform group-hover:scale-110 transition-transform duration-300">🏠</div>
                        <div>
                            <div class="font-medium text-lg text-stone-800">Kelola Keluarga</div>
                            <div class="text-amber-700 text-sm font-light">Fitur Manajemen Keluarga</div>
                        </div>
                    </div>
                    <div class="mt-6 h-1 bg-stone-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-amber-500 to-stone-600 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 ease-out"></div>
                    </div>
                </div>
            </a>

            <a href="#" class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-orange-200/50 to-stone-200/50 rounded-2xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="relative bg-gradient-to-br from-orange-50/80 to-stone-50/80 backdrop-blur-sm border border-stone-200/50 text-stone-700 p-8 rounded-2xl hover:border-orange-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-earth hover:shadow-orange">
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl transform group-hover:scale-110 transition-transform duration-300">💬</div>
                        <div>
                            <div class="font-medium text-lg text-stone-800">Kelola Diskusi</div>
                            <div class="text-orange-700 text-sm font-light">Fitur Diskusi Khusus Admin</div>
                        </div>
                    </div>
                    <div class="mt-6 h-1 bg-stone-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-orange-500 to-stone-600 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 ease-out"></div>
                    </div>
                </div>
            </a>

            <div class="group relative">
                <div class="absolute -inset-0.5 bg-gradient-to-br from-yellow-200/50 to-stone-200/50 rounded-2xl blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                <div class="relative bg-gradient-to-br from-yellow-50/80 to-stone-50/80 backdrop-blur-sm border border-stone-200/50 text-stone-700 p-8 rounded-2xl hover:border-yellow-300/70 transition-all duration-300 transform group-hover:scale-[1.02] shadow-earth hover:shadow-yellow">
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl transform group-hover:scale-110 transition-transform duration-300">⚡</div>
                        <div>
                            <div class="font-medium text-lg text-stone-800">System Monitor</div>
                            <div class="text-yellow-700 text-sm font-light">Monitor Platform Health</div>
                        </div>
                    </div>
                    <div class="mt-6 h-1 bg-stone-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-yellow-500 to-stone-600 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 ease-out"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #fafaf9 0%, #f5f5f4 25%, #e7e5e4 50%, #fef7e3 75%, #fafaf9 100%);
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
    
    /* Earth-toned elegant shadows */
    .shadow-earth {
        box-shadow: 
            0 4px 6px -1px rgba(87, 83, 78, 0.06),
            0 2px 4px -1px rgba(87, 83, 78, 0.04),
            0 10px 15px -3px rgba(87, 83, 78, 0.08),
            0 20px 25px -5px rgba(87, 83, 78, 0.05);
    }
    
    .shadow-amber {
        box-shadow: 
            0 4px 6px -1px rgba(245, 158, 11, 0.08),
            0 2px 4px -1px rgba(245, 158, 11, 0.05),
            0 10px 15px -3px rgba(245, 158, 11, 0.1),
            0 20px 25px -5px rgba(245, 158, 11, 0.06);
    }
    
    .shadow-orange {
        box-shadow: 
            0 4px 6px -1px rgba(234, 88, 12, 0.08),
            0 2px 4px -1px rgba(234, 88, 12, 0.05),
            0 10px 15px -3px rgba(234, 88, 12, 0.1),
            0 20px 25px -5px rgba(234, 88, 12, 0.06);
    }
    
    .shadow-yellow {
        box-shadow: 
            0 4px 6px -1px rgba(234, 179, 8, 0.08),
            0 2px 4px -1px rgba(234, 179, 8, 0.05),
            0 10px 15px -3px rgba(234, 179, 8, 0.1),
            0 20px 25px -5px rgba(234, 179, 8, 0.06);
    }
    
    /* Custom scrollbar with earth tones */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(250, 250, 249, 0.8);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #a8a29e, #d97706);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #78716c, #c2410c);
    }
    
    /* Smooth transitions for all elements */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Refined typography with earth tones */
    h1, h2, h3, h4, h5, h6 {
        letter-spacing: -0.025em;
        color: #57534e;
    }
    
    /* Subtle backdrop effects */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    
    /* Natural texture overlay */
    .bg-texture::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(120, 113, 108, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(245, 158, 11, 0.02) 0%, transparent 50%);
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Earth Tone Dashboard loaded');
        
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
                
                // Earth-toned notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-white/90 backdrop-blur-sm border border-stone-200 text-stone-700 px-6 py-4 rounded-2xl shadow-earth z-50 transform translate-x-full transition-all duration-500';
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-amber-600 rounded-full animate-gentle-pulse"></div>
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
        const jumlahKeluarga = {{ $jumlahKeluarga ?? 0 }};
        const jumlahDiskusi = {{ $jumlahDiskusi ?? 0 }};

        console.log('Chart data:', { jumlahKeluarga, jumlahDiskusi });

        try {
            window.statistikChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Keluarga', 'Diskusi', 'System'],
                    datasets: [{
                        label: 'Count',
                        data: [jumlahKeluarga, jumlahDiskusi, 100],
                        backgroundColor: [
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(234, 88, 12, 0.8)',
                            'rgba(234, 179, 8, 0.8)'
                        ],
                        borderColor: [
                            'rgba(245, 158, 11, 1)',
                            'rgba(234, 88, 12, 1)',
                            'rgba(234, 179, 8, 1)'
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
                            text: 'Dashboard Statistics',
                            color: '#57534e',
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
                                color: '#78716c',
                                font: {
                                    size: 14,
                                    family: 'system-ui'
                                }
                            },
                            grid: {
                                color: 'rgba(168, 162, 158, 0.2)',
                                borderColor: 'rgba(168, 162, 158, 0.3)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#78716c',
                                font: {
                                    size: 14,
                                    family: 'system-ui'
                                }
                            },
                            grid: {
                                color: 'rgba(168, 162, 158, 0.2)',
                                borderColor: 'rgba(168, 162, 158, 0.3)'
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

            console.log('Earth Chart initialized successfully');
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