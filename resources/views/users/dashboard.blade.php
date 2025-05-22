@extends('layouts.users')

@section('title', 'Dashboard Pengguna')

@section('header')
    <h2 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }} 👋</h2>
@endsection

@section('content')
    {{-- Welcome Section --}}
    <section class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <h3 class="text-xl font-semibold text-blue-700">Selamat Datang di Portal Pengguna</h3>
            <p class="text-gray-600 mt-2">
                Nikmati kemudahan dalam mengakses data keluarga, jadwal ibadah, dan ruang diskusi.
            </p>
        </div>
    </section>

    {{-- Info Cards --}}
    <section class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-5 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="text-sm text-blue-800 uppercase mb-1">👨‍👩‍👧‍👦 Keluarga</h4>
                <p class="text-3xl font-bold text-blue-900">12</p>
            </div>
            <div class="bg-gradient-to-r from-green-100 to-green-200 p-5 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="text-sm text-green-800 uppercase mb-1">🕊️ Jadwal Ibadah</h4>
                <p class="text-3xl font-bold text-green-900">0</p>
            </div>
            <div class="bg-gradient-to-r from-purple-100 to-purple-200 p-5 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="text-sm text-purple-800 uppercase mb-1">💬 Diskusi</h4>
                <p class="text-3xl font-bold text-purple-900">0</p>
            </div>
        </div>
    </section>

    {{-- Quick Links --}}
    <section class="px-4 sm:px-6 lg:px-8 py-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Navigasi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="#" class="bg-blue-50 p-4 rounded-lg border border-blue-200 hover:bg-blue-100 transition flex items-center space-x-3">
                <span>📁</span>
                <span class="text-blue-800 font-medium">Lihat Data Keluarga</span>
            </a>
            <a href="#" class="bg-green-50 p-4 rounded-lg border border-green-200 hover:bg-green-100 transition flex items-center space-x-3">
                <span>📆</span>
                <span class="text-green-800 font-medium">Lihat Jadwal Ibadah</span>
            </a>
            <a href="#" class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 hover:bg-yellow-100 transition flex items-center space-x-3">
                <span>💬</span>
                <span class="text-yellow-800 font-medium">Bergabung Diskusi, Berikan Tanggapan!</span>
            </a>
        </div>
    </section>

    {{-- Optional Chart Section --}}
    <section class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h4 class="text-lg font-semibold mb-4">Aktivitas Anda</h4>
            <div class="relative h-[300px] w-full">
                <canvas id="userChart"></canvas>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('userChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Keluarga', 'Ibadah', 'Diskusi'],
                datasets: [{
                    label: 'Data Anda',
                    data: [{{ $jumlahKeluarga ?? 0 }}, {{ $jumlahJadwal ?? 0 }}, {{ $jumlahDiskusi ?? 0 }}],
                    backgroundColor: ['#3b82f6', '#10b981', '#8b5cf6'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Statistik Anda', font: { size: 16 } }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
