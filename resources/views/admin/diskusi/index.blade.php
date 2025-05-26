@extends('layouts.admin')

@section('content')
<h2>Daftar Diskusi</h2>
<a href="{{ route('diskusi.create') }}">Tambah Diskusi</a>
@foreach ($diskusi as $d)
    <div>
        <h4>{{ $d->topik }} ({{ $d->agama->nama }})</h4>
        <p>{{ $d->isi }}</p>
        <small>Oleh: {{ $d->user->name }}</small>
        <br>
        <a href="{{ route('diskusi.edit', $d->id) }}">Edit</a>
        <form action="{{ route('diskusi.destroy', $d->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </div>
@endforeach
@endsection
