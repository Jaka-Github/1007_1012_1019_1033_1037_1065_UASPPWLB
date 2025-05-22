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
                    <tr data-keluarga-id="{{ $keluarga->id }}" data-id="{{ $anggota->id }}" class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
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
                                <button class="save-btn bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 hidden">Save</button>
                                <button class="cancel-btn bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500 hidden">Cancel</button>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = '{{ csrf_token() }}';

    document.querySelectorAll('tbody tr').forEach(row => {
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        const deleteBtn = row.querySelector('.delete-btn');
        const inputs = row.querySelectorAll('input, select');

        // Simpan nilai asli
        inputs.forEach(input => {
            input.dataset.value = input.value;
            input.setAttribute('readonly', true);
            input.setAttribute('disabled', true);
        });

        editBtn.addEventListener('click', () => {
            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.removeAttribute('disabled');
            });
            editBtn.classList.add('hidden');
            saveBtn.classList.remove('hidden');
            cancelBtn.classList.remove('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            inputs.forEach(input => {
                input.value = input.dataset.value;
                input.setAttribute('readonly', true);
                input.setAttribute('disabled', true);
            });
            editBtn.classList.remove('hidden');
            saveBtn.classList.add('hidden');
            cancelBtn.classList.add('hidden');
        });

        saveBtn.addEventListener('click', async () => {
            const keluargaId = row.dataset.keluargaId;
            const anggotaId = row.dataset.id;

            // Siapkan data dari inputs
            const data = {
                nama: row.querySelector('input[name="nama"]').value,
                umur: row.querySelector('input[name="umur"]').value,
                jenis_kelamin: row.querySelector('select[name="jenis_kelamin"]').value,
                alamat: row.querySelector('input[name="alamat"]').value,
                agama_id: row.querySelector('select[name="agama_id"]').value,
                _token: csrfToken,
                _method: 'PUT'
            };

            try {
                const response = await fetch(`/admin/keluarga/${keluargaId}/anggota/${anggotaId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        nama: ...,
                        umur: ...,
                        jenis_kelamin: ...,
                        alamat: ...,
                        agama_id: ...,
                    }),
                });


                if (!response.ok) {
                    const err = await response.json();
                    alert('Gagal menyimpan data: ' + (err.message || 'Unknown error'));
                    return;
                }

                const result = await response.json();

                // Update dataset value agar cancel tidak reset ke data lama
                inputs.forEach(input => {
                    input.dataset.value = input.value;
                    input.setAttribute('readonly', true);
                    input.setAttribute('disabled', true);
                });

                editBtn.classList.remove('hidden');
                saveBtn.classList.add('hidden');
                cancelBtn.classList.add('hidden');

                alert('Data berhasil disimpan!');
            } catch (error) {
                alert('Error saat menyimpan data: ' + error.message);
            }
        });

        deleteBtn.addEventListener('click', async () => {
            if (!confirm('Yakin ingin menghapus anggota ini?')) return;

            const keluargaId = row.dataset.keluargaId;
            const anggotaId = row.dataset.id;

            try {
                const response = await fetch(`/admin/keluarga/${keluargaId}/anggota/${anggotaId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        _token: csrfToken,
                        _method: 'DELETE',
                    })
                });

                if (!response.ok) {
                    const err = await response.json();
                    alert('Gagal menghapus data: ' + (err.message || 'Unknown error'));
                    return;
                }

                // Hapus baris tabel dari DOM
                row.remove();
                alert('Data berhasil dihapus!');
            } catch (error) {
                alert('Error saat menghapus data: ' + error.message);
            }
        });
    });
});
</script>
@endsection
