@extends('layouts.admin') {{-- atau layout admin, sesuaikan --}}

@section('content')
<div class="container">
    <h2>Edit Diskusi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('diskusi.update', $diskusi->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Topik --}}
        <div class="mb-3">
            <label for="topik" class="form-label">Topik</label>
            <input type="text" name="topik" class="form-control" id="topik" value="{{ old('topik', $diskusi->topik) }}" required>
        </div>

        {{-- Isi --}}
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Diskusi</label>
            <textarea name="isi" class="form-control" id="isi" rows="5" required>{{ old('isi', $diskusi->isi) }}</textarea>
        </div>

        {{-- Agama --}}
        <div class="mb-3">
            <label for="agama_id" class="form-label">Agama</label>
            <select name="agama_id" class="form-select" required>
                <option value="">-- Pilih Agama --</option>
                @foreach ($agamaList as $agama)
                    <option value="{{ $agama->id }}" {{ $agama->id == $diskusi->agama_id ? 'selected' : '' }}>
                        {{ $agama->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('diskusi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
