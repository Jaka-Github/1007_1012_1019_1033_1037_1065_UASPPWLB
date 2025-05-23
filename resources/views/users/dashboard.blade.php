@extends('layouts.users')

@section('title', 'Dashboard Pengguna')

@section('header')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Halo, {{ Auth::user()->name }} 👋</h2>
            <p class="text-gray-600 mt-1">Selamat datang kembali di dashboard Anda</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Online
            </span>
        </div>
    </div>
@endsection

@section('content')
    {{-- Welcome Banner --}}
    <div class="mb-8">
        <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-16 h-16 bg-white bg-opacity-10 rounded-full"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-2">Selamat Datang di Portal Keluarga Pendikar</h3>
                <p class="text-indigo-100 mb-4">Kelola data keluarga, ikuti jadwal ibadah, dan berpartisipasi dalam diskusi komunitas</p>
                <button class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                    Mulai Eksplorasi
                </button>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Anggota Keluarga -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 text-sm font-semibold uppercase tracking-wide">Anggota Keluarga</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $jumlahKeluarga ?? 0 }}</p>
                    <p class="text-gray-500 text-sm mt-1">Total anggota terdaftar</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Jadwal Ibadah -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-600 text-sm font-semibold uppercase tracking-wide">Jadwal Ibadah</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $jumlahJadwal ?? 0 }}</p>
                    <p class="text-gray-500 text-sm mt-1">Kegiatan mendatang</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tanggapan -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-600 text-sm font-semibold uppercase tracking-wide">Tanggapan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $jumlahTanggapan ?? 0 }}</p>
                    <p class="text-gray-500 text-sm mt-1">Tanggapan Anda</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Aksi Cepat
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="#" class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 group transition-colors duration-200">
                <div class="bg-blue-500 p-2 rounded-lg mr-4 group-hover:bg-blue-600 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2a5.002 5.002 0 00-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2a5.002 5.002 0 01.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-blue-900">Lihat Anggota Keluarga</h4>
                    <p class="text-blue-700 text-sm">Kelola data anggota keluarga Anda</p>
                </div>
            </a>
            <a href="#" class="flex items-center p-4 bg-green-50 rounded-lg border border-green-200 hover:bg-green-100 group transition-colors duration-200">
                <div class="bg-green-500 p-2 rounded-lg mr-4 group-hover:bg-green-600 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-green-900">Jadwal Ibadah</h4>
                    <p class="text-green-700 text-sm">Lihat jadwal ibadah terbaru</p>
                </div>
            </a>
            <a href="#" class="flex items-center p-4 bg-purple-50 rounded-lg border border-purple-200 hover:bg-purple-100 group transition-colors duration-200">
                <div class="bg-purple-500 p-2 rounded-lg mr-4 group-hover:bg-purple-600 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-purple-900">Berikan Tanggapan</h4>
                    <p class="text-purple-700 text-sm">Bergabung dalam diskusi komunitas</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Statistik Aktivitas Anda
            </h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full hover:bg-indigo-200 transition-colors duration-200">
                    Minggu Ini
                </button>
                <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">
                    Bulan Ini
                </button>
            </div>
        </div>
        <div class="relative h-[350px] w-full">
            <canvas id="userChart"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('userChart').getContext('2d');
        
        // Create gradient
        const gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
        gradient1.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
        gradient1.addColorStop(1, 'rgba(59, 130, 246, 0.1)');
        
        const gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
        gradient2.addColorStop(0, 'rgba(16, 185, 129, 0.8)');
        gradient2.addColorStop(1, 'rgba(16, 185, 129, 0.1)');
        
        const gradient3 = ctx.createLinearGradient(0, 0, 0, 300);
        gradient3.addColorStop(0, 'rgba(139, 92, 246, 0.8)');
        gradient3.addColorStop(1, 'rgba(139, 92, 246, 0.1)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Keluarga', 'Jadwal Ibadah', 'Diskusi'],
                datasets: [{
                    label: 'Aktivitas Anda',
                    data: [
                        {{ $jumlahKeluarga ?? 12 }}, 
                        {{ $jumlahJadwal ?? 5 }}, 
                        {{ $jumlahTanggapan ?? 8 }}
                    ],
                    backgroundColor: [gradient1, gradient2, gradient3],
                    borderColor: ['#3b82f6', '#10b981', '#8b5cf6'],
                    borderWidth: 2,
                    borderRadius: 8,
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
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                return 'Total: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#6b7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: 'rgba(107, 114, 128, 0.1)'
                        },
                        ticks: {
                            stepSize: 5,
                            font: {
                                size: 12
                            },
                            color: '#6b7280',
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    });
</script>
@endpush
