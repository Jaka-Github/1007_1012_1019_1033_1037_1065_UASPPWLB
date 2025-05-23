@extends('layouts.admin')

@section('title', 'Keluarga Pendikar')

@section('header')
    <script src="//unpkg.com/alpinejs" defer></script>
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        CRUD Keluarga Pendikar 
    </h2>
@endsection

@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 max-w-md w-full px-4"
    >
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg">
            {{ session('success') }}
        </div>
    </div>
@endif

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8" x-data="keluargaManager()">
    {{-- Form Tambah Keluarga --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Tambah Keluarga</h3>
        <form action="{{ route('admin.keluarga.store') }}" method="POST">
            @csrf
            <div class="flex items-center space-x-4">
                <input type="text" name="nama_keluarga" placeholder="Nama Keluarga" class="border border-gray-300 rounded px-4 py-2 w-full" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">Tambah</button>
            </div>
        </form>
    </div>

    {{-- Daftar Keluarga --}}
    <div class="grid md:grid-cols-3 gap-6 pb-8">
        @foreach($keluargas as $keluarga)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 transition duration-300 ease-in-out transform hover:scale-[1.02] hover:shadow-lg hover:border-blue-200">
            <h4 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-between">
                {{ $keluarga->nama_keluarga }}
                <span class="ml-2 bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $keluarga->anggota_count }} anggota
                </span>
            </h4>
            <br>
            <br>
            <div class="flex justify-between items-center flex-wrap gap-3">
                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.keluarga.destroy', $keluarga->id) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <button 
                        class="flex items-center text-red-600 hover:text-red-800 transition duration-200"
                        onclick="return confirm('Hapus keluarga ini?')"
                        type="submit"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                        </svg>
                        Hapus
                    </button>
                </form>

                {{-- Tombol Edit --}}
                <button 
                    @click="openEditModal({{ $keluarga->id }}, '{{ $keluarga->nama_keluarga }}')"
                    class="flex items-center text-yellow-600 hover:text-yellow-800 transition duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </button>

                {{-- Tombol Kelola Anggota --}}
                <a href="{{ route('admin.keluarga.anggota.index', $keluarga->id) }}" class="flex items-center text-blue-600 hover:text-blue-900 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola Anggota
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Modal Edit Keluarga --}}
    <div 
        x-show="showEditModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto" 
        style="display: none;"
    >
        {{-- Backdrop --}}
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
            @click="closeEditModal()"
        ></div>

        {{-- Modal Content --}}
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div 
                x-show="showEditModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
            >
                {{-- Modal Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 leading-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Keluarga
                    </h3>
                    <button 
                        @click="closeEditModal()"
                        class="text-gray-400 hover:text-gray-600 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form :action="`{{ route('admin.keluarga.index') }}/${editId}`" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="edit_nama_keluarga" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Keluarga
                        </label>
                        <input 
                            type="text" 
                            id="edit_nama_keluarga"
                            name="nama_keluarga" 
                            x-model="editNama"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan nama keluarga"
                            required
                        >
                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex justify-end space-x-3">
                        <button 
                            type="button"
                            @click="closeEditModal()"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transform hover:scale-105 transition duration-200 shadow-lg"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function keluargaManager() {
    return {
        showEditModal: false,
        editId: null,
        editNama: '',

        openEditModal(id, nama) {
            this.editId = id;
            this.editNama = nama;
            this.showEditModal = true;
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        },

        closeEditModal() {
            this.showEditModal = false;
            this.editId = null;
            this.editNama = '';
            // Restore body scroll
            document.body.style.overflow = 'auto';
        }
    }
}
</script>

@endsection