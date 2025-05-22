@extends('layouts.admin')


@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        Dashboard Admin
    </h2>
@endsection

@section('content')
    {{-- Section: Welcome Message --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white shadow-md">
            <h3 class="text-xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
            <p class="text-sm">
                Anda login sebagai <strong>Admin</strong>. Gunakan panel ini untuk mengelola data pengguna, jadwal, diskusi, dan lainnya.
            </p>
        </div>
    </section>

    {{-- Section: Statistik --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.keluarga.index') }}" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-sm text-gray-500 uppercase mb-2">Jumlah Keluarga</h4>
                <p class="text-2xl font-bold text-blue-600">{{ $jumlahKeluarga }}</p>
            </a>
            <a href="#" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-sm text-gray-500 uppercase mb-2">Jadwal Ibadah</h4>
                <p class="text-2xl font-bold text-green-600">{{ $jumlahJadwal }}</p>
            </a>
            <a href="#" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-sm text-gray-500 uppercase mb-2">Diskusi Aktif</h4>
                <p class="text-2xl font-bold text-purple-600">{{ $jumlahDiskusi }}</p>
            </a>
        </div>

        {{-- Grafik --}}
        <div class="bg-white mt-8 p-6 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Grafik Statistik</h4>
            <div class="relative" style="height: 400px;">
                <canvas id="statistikChart"></canvas>
            </div>
        </div>
    </section>

    {{-- Section: Quick Actions --}}
    <section class="py-6 px-4 sm:px-6 lg:px-8">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.keluarga.index') }}" class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded hover:bg-blue-200">
                🔧 Kelola Keluarga Pendikar
            </a>
            <a href="#" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded hover:bg-green-200">
                📅 Kelola Jadwal
            </a>
            <a href="#" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded hover:bg-yellow-200">
                💬 Kelola Diskusi
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard loaded');
        
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
                alert(`Navigasi ke: ${actionName}`);
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
        const jumlahJadwal = {{ $jumlahJadwal ?? 0 }};
        const jumlahDiskusi = {{ $jumlahDiskusi ?? 0 }};

        console.log('Chart data:', { jumlahKeluarga, jumlahJadwal, jumlahDiskusi });

        try {
            window.statistikChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Keluarga', 'Jadwal', 'Diskusi'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [jumlahKeluarga, jumlahJadwal, jumlahDiskusi],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(139, 92, 246, 0.8)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(139, 92, 246, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Statistik Dashboard'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            console.log('Chart initialized successfully');
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