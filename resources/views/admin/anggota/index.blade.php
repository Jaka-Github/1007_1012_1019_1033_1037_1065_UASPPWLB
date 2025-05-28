@extends('layouts.admin')


@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">
        Daftar Anggota Keluarga: <span class="text-blue-600">{{ $keluarga->nama_keluarga }}</span>
    </h2>

    @if($anggota->isEmpty())
        <div class="flex items-center justify-between bg-yellow-100 text-yellow-800 p-4 rounded mb-6">
            <div>Belum ada anggota untuk keluarga ini.</div>
            <a href="{{ route('admin.keluarga.anggota.create', $keluarga->id) }}" 
                class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                + Tambah Anggota
            </a>
        </div>
    @else
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.keluarga.anggota.create', $keluarga->id) }}" 
           class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
            + Tambah Anggota
        </a>
    </div>

    <div class="overflow-x-auto shadow-2xl rounded-2xl">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-blue-600 text-left">
                    <th class="py-4 px-6 font-medium text-white rounded-tl-2xl">No</th>
                    <th class="py-4 px-6 font-medium text-white">Nama Anggota</th>
                    <th class="py-4 px-6 font-medium text-white">Umur</th>
                    <th class="py-4 px-6 font-medium text-white">User</th>
                    <th class="py-4 px-6 font-medium text-white">Jenis Kelamin</th>
                    <th class="py-4 px-6 font-medium text-white">Alamat</th>
                    <th class="py-4 px-6 font-medium text-white">Agama</th>
                    <th class="py-4 px-6 font-medium text-white rounded-tr-2xl">Aksi</th>
                </tr>
            </thead>
            <tbody class="rounded-b-2xl overflow-hidden">
                @foreach($anggota as $index => $a)
                    <tr data-keluarga-id="{{ $keluarga->id }}" data-id="{{ $a->id }}" 
                        class="{{ $index % 2 == 0 ? 'bg-white hover:bg-gray-50' : 'bg-gray-50 hover:bg-gray-100' }} transition-colors duration-150 {{ $loop->last ? 'rounded-b-2xl' : '' }}">
                        <td class="py-4 px-6 {{ $loop->last ? 'rounded-bl-2xl' : '' }}">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <input type="text" name="nama" value="{{ old('nama', $a->nama) }}" 
                                class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" readonly>
                        </td>
                        <td class="py-4 px-6">
                            <input type="number" name="umur" value="{{ old('umur', $a->umur) }}" 
                                class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" readonly>
                        </td>
                        <td class="py-4 px-6">
                            <select name="user_id" class="form-select w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <option value="" {{ $a->user_id == null ? 'selected' : '' }}>-- Tidak Ada User --</option>
                                @foreach ($userList as $user)
                                    <option value="{{ $user->id }}" {{ $a->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="py-4 px-6">
                            <select name="jenis_kelamin" class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" disabled>
                                <option value="Laki-laki" {{ $a->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $a->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </td>
                        <td class="py-4 px-6">
                            <input type="text" name="alamat" value="{{ old('alamat', $a->alamat) }}" 
                                class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" readonly>
                        </td>
                        <td class="py-4 px-6">
                            <select name="agama_id" class="border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" disabled>
                                <option value="">-- Pilih Agama --</option>
                                @foreach($agamaList as $agama)
                                    <option value="{{ $agama->id }}" {{ $a->agama_id == $agama->id ? 'selected' : '' }}>
                                        {{ $agama->nama_agama }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <!-- Action Buttons-->
                        <td class="py-4 px-6 {{ $loop->last ? 'rounded-br-2xl' : '' }}">
                            <div class="flex space-x-2 items-center text-sm font-medium">
                                <button class="edit-btn text-amber-600 hover:text-white px-3 py-2 rounded-lg hover:bg-amber-500 transition-all duration-200 transform hover:scale-105"
                                        style="padding: 8px 12px; color: #d97706;">
                                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </button>

                                <button class="save-btn text-green-600 hover:text-white px-3 py-2 rounded-lg hover:bg-green-500 transition-all duration-200 transform hover:scale-105"
                                        style="padding: 8px 12px; color: #16a34a; display: none;">
                                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Save
                                </button>

                                <button class="cancel-btn text-gray-600 hover:text-white px-3 py-2 rounded-lg hover:bg-gray-300 transition-all duration-200 transform hover:scale-105"
                                        style="padding: 8px 12px; color: #6b7280; display: none;">
                                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Cancel
                                </button>

                                <button class="delete-btn text-red-600 hover:text-white px-3 py-2 rounded-lg hover:bg-red-400 transition-all duration-200 transform hover:scale-105"
                                        style="padding: 8px 12px; color: #dc2626;">
                                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-3h2a1 1 0 011 1v1H8V5a1 1 0 011-1z"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif

    <div class="mt-8">
        <a href="{{ route('admin.keluarga.index') }}" 
           class="inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Keluarga
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
console.log('Script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    
    const csrfToken = '{{ csrf_token() }}';
    console.log('CSRF Token:', csrfToken);
    
    const tableRows = document.querySelectorAll('tbody tr');
    console.log('Found rows:', tableRows.length);
    
    tableRows.forEach((row, index) => {
        console.log(`Processing row ${index}:`, row);
        
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        const deleteBtn = row.querySelector('.delete-btn');
        
        console.log('Buttons found:', {
            edit: !!editBtn,
            save: !!saveBtn,
            cancel: !!cancelBtn,
            delete: !!deleteBtn
        });
        
        if (!editBtn || !saveBtn || !cancelBtn || !deleteBtn) {
            console.error('Missing buttons in row:', row);
            return;
        }
        
        const inputs = row.querySelectorAll('input, select');
        console.log('Inputs found:', inputs.length);
        
        // Simpan nilai original dan set readonly/disabled
        inputs.forEach(input => {
            input.dataset.originalValue = input.value;
        });
        
        // Set initial state
        setReadonlyState(inputs, true);
        
        // Edit button
        editBtn.onclick = function(e) {
            e.preventDefault();
            console.log('Edit clicked for row:', index);
            alert('Edit button clicked! You can now edit the field.');
            
            setReadonlyState(inputs, false);
            toggleButtons(editBtn, saveBtn, cancelBtn, 'edit');
        };
        
        // Cancel button  
        cancelBtn.onclick = function(e) {
            e.preventDefault();
            console.log('Cancel clicked for row:', index);
            
            // Reset values
            inputs.forEach(input => {
                input.value = input.dataset.originalValue;
            });
            
            setReadonlyState(inputs, true);
            toggleButtons(editBtn, saveBtn, cancelBtn, 'cancel');
        };
        
        // Save button
        saveBtn.onclick = function(e) {
            e.preventDefault();
            console.log('Save clicked for row:', index);

            const keluargaId = row.getAttribute('data-keluarga-id');
            const anggotaId = row.getAttribute('data-id');

            const data = {
                nama: row.querySelector('input[name="nama"]').value,
                user_id: row.querySelector('select[name="user_id"]').value,  // perbaikan di sini
                umur: row.querySelector('input[name="umur"]').value,
                jenis_kelamin: row.querySelector('select[name="jenis_kelamin"]').value,
                alamat: row.querySelector('input[name="alamat"]').value,
                agama_id: row.querySelector('select[name="agama_id"]').value
            };

            saveData(keluargaId, anggotaId, data, csrfToken)
                .then(success => {
                    if (success) {
                        inputs.forEach(input => {
                            input.dataset.originalValue = input.value;
                        });
                        setReadonlyState(inputs, true);
                        toggleButtons(editBtn, saveBtn, cancelBtn, 'save');
                        alert('Data berhasil disimpan!');
                    }
                });
        };

        
        // Delete button
        deleteBtn.onclick = function(e) {
            e.preventDefault();
            console.log('Delete clicked for row:', index);
            
            if (!confirm('Yakin ingin menghapus anggota ini?')) return;
            
            const keluargaId = row.getAttribute('data-keluarga-id');
            const anggotaId = row.getAttribute('data-id');
            
            console.log('Deleting IDs:', { keluarga: keluargaId, anggota: anggotaId });
            
            // Test delete function
            deleteData(keluargaId, anggotaId, csrfToken)
                .then(success => {
                    if (success) {
                        row.remove();
                        alert('Data berhasil dihapus!');
                    }
                });
        };
    });
});

function setReadonlyState(inputs, readonly) {
    inputs.forEach(input => {
        if (input.tagName.toLowerCase() === 'select') {
            input.disabled = readonly;
        } else {
            input.readOnly = readonly;
        }
    });
}

function toggleButtons(editBtn, saveBtn, cancelBtn, action) {
    if (action === 'edit') {
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
        cancelBtn.style.display = 'inline-block';
    } else {
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
    }
}

async function saveData(keluargaId, anggotaId, data, csrfToken) {
    try {
        const response = await fetch(`/admin/keluarga/${keluargaId}/anggota/${anggotaId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data)
        });
        
        console.log('Save response status:', response.status);
        
        if (!response.ok) {
            const err = await response.json();
            console.error('Save error:', err);
            alert('Gagal menyimpan: ' + (err.message || response.statusText));
            return false;
        }
        
        const result = await response.json();
        console.log('Save success:', result);
        return true;
        
    } catch (error) {
        console.error('Save fetch error:', error);
        alert('Error: ' + error.message);
        return false;
    }
}

async function deleteData(keluargaId, anggotaId, csrfToken) {
    try {
        const response = await fetch(`/admin/keluarga/${keluargaId}/anggota/${anggotaId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json', 
                'X-CSRF-TOKEN': csrfToken,
            }
        });
        
        console.log('Delete response status:', response.status);
        
        if (!response.ok) {
            const err = await response.json();
            console.error('Delete error:', err);
            alert('Gagal menghapus: ' + (err.message || response.statusText));
            return false;
        }
        
        const result = await response.json();
        console.log('Delete success:', result);
        return true;
        
    } catch (error) {
        console.error('Delete fetch error:', error);
        alert('Error: ' + error.message);
        return false;
    }
}
</script>
@endpush