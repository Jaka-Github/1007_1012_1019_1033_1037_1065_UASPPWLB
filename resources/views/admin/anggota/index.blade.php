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
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Tambah Anggota
            </a>
        </div>
    @else
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.keluarga.anggota.create', $keluarga->id) }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Tambah Anggota
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-3 px-6 font-medium text-gray-600">#</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Nama Anggota</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Umur</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Jenis Kelamin</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Alamat</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Agama</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggota as $index => $a)
                    <tr data-keluarga-id="{{ $keluarga->id }}" data-id="{{ $a->id }}" class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">
                            <input type="text" name="nama" value="{{ old('nama', $a->nama) }}" 
                                class="border rounded px-2 py-1 w-full" readonly>
                        </td>
                        <td class="py-3 px-6">
                            <input type="number" name="umur" value="{{ old('umur', $a->umur) }}" 
                                class="border rounded px-2 py-1 w-full" readonly>
                        </td>
                        <td class="py-3 px-6">
                            <select name="jenis_kelamin" class="border rounded px-2 py-1 w-full" disabled>
                                <option value="Laki-laki" {{ $a->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $a->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </td>
                        <td class="py-3 px-6">
                            <input type="text" name="alamat" value="{{ old('alamat', $a->alamat) }}" 
                                class="border rounded px-2 py-1 w-full" readonly>
                        </td>
                        <td class="py-3 px-6">
                            <select name="agama_id" class="border rounded px-2 py-1 w-full" disabled>
                                <option value="">-- Pilih Agama --</option>
                                @foreach($agamaList as $agama)
                                    <option value="{{ $agama->id }}" {{ $a->agama_id == $agama->id ? 'selected' : '' }}>
                                        {{ $agama->nama_agama }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="py-3 px-6">
                            <div class="flex space-x-2 items-center">
                                <button class="edit-btn bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button class="save-btn bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700" style="display: none;">Save</button>
                                <button class="cancel-btn bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500" style="display: none;">Cancel</button>
                                <button class="delete-btn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 ml-2">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif

    <div class="mt-6">
        <a href="{{ route('admin.keluarga.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700">
            &larr; Kembali ke Daftar Keluarga
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
            alert('Edit button clicked! Check console for details.');
            
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
            
            console.log('IDs:', { keluarga: keluargaId, anggota: anggotaId });
            
            const data = {
                nama: row.querySelector('input[name="nama"]').value,
                umur: row.querySelector('input[name="umur"]').value,
                jenis_kelamin: row.querySelector('select[name="jenis_kelamin"]').value,
                alamat: row.querySelector('input[name="alamat"]').value,
                agama_id: row.querySelector('select[name="agama_id"]').value
            };
            
            console.log('Data to save:', data);
            
            // Test save function
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