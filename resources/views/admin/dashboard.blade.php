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
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-sm text-gray-500 uppercase mb-2">Jumlah Pengguna</h4>
                <p class="text-2xl font-bold text-blue-600">125</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-sm text-gray-500 uppercase mb-2">Jadwal Ibadah</h4>
                <p class="text-2xl font-bold text-green-600">32</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-sm text-gray-500 uppercase mb-2">Diskusi Aktif</h4>
                <p class="text-2xl font-bold text-purple-600">8</p>
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
    });
</script>
@endpush


