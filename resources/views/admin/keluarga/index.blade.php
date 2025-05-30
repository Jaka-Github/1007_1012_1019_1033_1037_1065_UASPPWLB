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
<div class="px-4 py-6 sm:px-6 lg:px-8 min-h-screen" x-data="keluargaManager()">
    {{-- Header Section --}}
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="bg-blue-600 p-3 rounded-xl shadow-lg mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Keluarga</h1>
                <p class="text-gray-600 mt-1">Kelola data keluarga dan anggotanya</p>
            </div>
        </div>
    </div>

    {{-- Form Tambah Keluarga - Enhanced --}}
    <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-8 mb-8 relative overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute top-0 right-0 w-40 h-40 bg-blue-50 rounded-full -translate-y-20 translate-x-20 opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-indigo-50 rounded-full translate-y-16 -translate-x-16 opacity-50"></div>
        
        <div class="relative z-10">
            <div class="flex items-center mb-6">
                <div class="bg-blue-600 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Tambah Keluarga Baru</h3>
            </div>
            
            <form action="{{ route('admin.keluarga.store') }}" method="POST">
                @csrf
                <div class="flex flex-col sm:flex-row items-end space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="flex-1">
                        <label for="nama_keluarga" class="block text-sm font-semibold text-gray-700 mb-2">Nama Keluarga</label>
                        <input type="text" 
                               id="nama_keluarga"
                               name="nama_keluarga" 
                               placeholder="Masukkan nama keluarga" 
                               class="border-2 border-gray-200 rounded-xl px-4 py-3 w-full focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300" 
                               required>
                    </div>
                    <button type="submit" 
                            class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Keluarga
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Keluarga - Enhanced --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 grid md:grid-cols-2 lg:grid-cols-3 gap-8 pb-2 mt-14 items-center">
            Daftar Keluarga
        </h2>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 pb-8">
        @foreach($keluargas as $keluarga)
        <div class="group bg-white rounded-2xl shadow-lg border-2 border-blue-100 p-6 transition-all duration-300 ease-in-out transform hover:scale-[1.03] hover:shadow-2xl hover:border-blue-300 relative overflow-hidden">
            
            {{-- Header --}}
            <div class="relative z-10 mb-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-center">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 group-hover:text-blue-700 transition duration-300">
                                {{ $keluarga->nama_keluarga }}
                            </h4>
                            <p class="text-gray-500 text-sm mt-1">Family Record</p>
                        </div>
                    </div>
                    
                    <div class="bg-gray-100 text-black text-sm font-bold px-3 py-2 rounded-full shadow-lg">
                        {{ $keluarga->anggota_count }} <span class="hidden sm:inline">anggota</span>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-between items-center flex-wrap gap-3">

                {{-- Tombol Edit --}}
                <button 
                    @click="openEditModal({{ $keluarga->id }}, '{{ $keluarga->nama_keluarga }}')"
                    class="flex items-center text-yellow-600 hover:text-white hover:bg-yellow-500 px-3 py-2 rounded-lg transition duration-300 border border-yellow-200 hover:border-yellow-500 group/btn"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="text-sm font-medium">Edit</span>
                </button>

                {{-- Tombol Hapus --}}
                <button 
                    @click="deleteKeluarga({{ $keluarga->id }})"
                    class="flex items-center text-red-500 hover:text-white hover:bg-red-500 px-3 py-2 rounded-lg transition duration-300 border border-red-200 hover:border-red-500 group/btn"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                    </svg>
                    <span class="text-sm font-medium">Hapus</span>
                </button>

                {{-- Tombol Kelola Anggota - Primary Action --}}
                <a href="{{ route('admin.keluarga.anggota.index', $keluarga->id) }}" 
                   class="flex items-center text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group/btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 text-white">
                        <path d="M8 1C6.103 1 4.5 2.603 4.5 4.5S6.103 8 8 8s3.5-1.603 3.5-3.5S9.897 1 8 1zM8 6.5c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM3 14c0-.368-.297-.667-.667-.667H2.333c-.368 0-.667.299-.667.667v1.333c0 .368.299.667.667.667h.667c.368 0 .667-.299.667-.667V14zm10 0c0-.368-.297-.667-.667-.667h-.667c-.368 0-.667.299-.667.667v1.333c0 .368.299.667.667.667h.667c.368 0 .667-.299.667-.667V14zM8 9.5c-2.573 0-4.667 2.094-4.667 4.667v2.333h9.334V14.167c0-2.573-2.094-4.667-4.667-4.667zm-3.333 4.667c0-1.83 1.503-3.333 3.333-3.333s3.333 1.503 3.333 3.333v.666H4.667v-.666z"/>
                    </svg>
                    <span class="text-sm font-bold">Kelola Anggota</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Empty State --}}
    @if($keluargas->isEmpty())
    <div class="text-center py-16">
        <div class="bg-blue-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada data keluarga</h3>
        <p class="text-gray-500 mb-6">Mulai dengan menambahkan keluarga pertama Anda</p>
        <button class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition duration-300">
            Tambah Keluarga Pertama
        </button>
    </div>
    @endif

    {{-- Form hapus tersembunyi --}}
    <form x-ref="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- Modal Edit Keluarga - Enhanced --}}
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
            class="fixed inset-0 bg-black bg-opacity-60 transition-opacity transition-backdrop-filter duration-10"
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
                class="inline-block align-bottom bg-white rounded-2xl px-6 pt-6 pb-6 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border-2 border-blue-100 relative"
            >
                {{-- Decorative Elements --}}
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -translate-y-16 translate-x-16 opacity-30"></div>

                {{-- Modal Header --}}
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="flex items-center">
                        <div class="bg-blue-600 p-3 rounded-xl shadow-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Edit Keluarga</h3>
                            <p class="text-gray-600 text-sm mt-1">Perbarui informasi keluarga</p>
                        </div>
                    </div>
                    <button 
                        @click="closeEditModal()"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form :action="`{{ route('admin.keluarga.index') }}/${editId}`" method="POST" class="relative z-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-8">
                        <label for="edit_nama_keluarga" class="block text-sm font-bold text-gray-700 mb-3">
                            Nama Keluarga
                        </label>
                        <input 
                            type="text" 
                            id="edit_nama_keluarga"
                            name="nama_keluarga" 
                            x-model="editNama"
                            class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300 bg-gray-50 focus:bg-white"
                            placeholder="Masukkan nama keluarga"
                            required
                        >
                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex justify-end space-x-4">
                        <button 
                            type="button"
                            @click="closeEditModal()"
                            class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
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
        },

        // FIX: Method untuk handle delete dengan confirmation
        deleteKeluarga(id) {
            if (confirm('Hapus keluarga ini?')) {
                // Set action URL dan submit form
                const form = this.$refs.deleteForm;
                form.action = `{{ route('admin.keluarga.index') }}/${id}`;
                form.submit();
            }
        }
    }
}
</script>

@endsection