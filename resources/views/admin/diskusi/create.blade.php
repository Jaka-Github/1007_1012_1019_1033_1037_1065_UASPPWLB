@extends('layouts.admin')

@section('content')
<h2>{{ isset($diskusi) ? 'Edit' : 'Tambah' }} Diskusi</h2>
<form method="POST" action="{{ isset($diskusi) ? route('diskusi.update', $diskusi->id) : route('diskusi.store') }}">
    @csrf
    @if(isset($diskusi)) @method('PUT') @endif

    <input type="text" name="topik" placeholder="Topik" value="{{ $diskusi->topik ?? '' }}">
    <textarea name="isi" placeholder="Isi">{{ $diskusi->isi ?? '' }}</textarea>

    <select name="agama_id">
        @foreach ($agamaList as $agama)
                    <option value="{{ $agama->id }}" {{ $agama->id == $diskusi->agama_id ? 'selected' : '' }}>
                        {{ $agama->nama }}
                    </option>
        @endforeach
    </select>

    <button type="submit">{{ isset($diskusi) ? 'Update' : 'Simpan' }}</button>
</form>
@endsection
