@extends('layouts.users')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Profil Pengguna</h1>
        <p class="text-gray-600">Informasi lengkap akun Anda</p>
    </div>

    <!-- Alert Messages -->
    @if(session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Header Stats -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <h2 class="text-lg font-semibold">Informasi Profil</h2>
                    <p class="text-indigo-100">{{ auth()->user()->name }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-lg p-3">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Form Profil -->
        <div class="px-6 py-4">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Nama dan Email -->
                <div class="space-y-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" 
                               class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                               class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-4">Perbarui Password</h3>
                <div class="space-y-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Password Lama</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" id="password" name="password" 
                               class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <!-- Delete Account Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold mb-4 text-red-600">Hapus Akun</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Jika Anda menghapus akun ini, semua data yang terkait akan hilang secara permanen. Pastikan untuk mengunduh data yang ingin Anda simpan sebelum melanjutkan.
                </p>

                <button type="button" 
                        onclick="openDeleteModal()" 
                        class="w-full py-2 px-4 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                    Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-2">Apakah Anda yakin ingin menghapus akun?</h3>
            <p class="text-sm text-gray-600 mt-2">
                Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. Masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun secara permanen.
            </p>
            
            <form id="deleteForm" action="{{ route('profile.destroy') }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                
                <div class="mb-4">
                    <label for="delete_password" class="sr-only">Password</label>
                    <input type="password" 
                           id="delete_password" 
                           name="password" 
                           placeholder="Password" 
                           class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500" 
                           required>
                    @error('password', 'userDeletion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-gray-25 {
        background-color: #fafafa;
    }
    
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
    
    .transition-colors {
        transition-property: background-color, border-color, color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
    
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('delete_password').focus();
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('delete_password').value = '';
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

// Show modal if there are deletion errors
@if($errors->userDeletion->isNotEmpty())
    document.addEventListener('DOMContentLoaded', function() {
        openDeleteModal();
    });
@endif
</script>
@endsection
