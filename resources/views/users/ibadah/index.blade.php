@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📅 Rencana Ibadah</h2>
        <a href="{{ route('ibadah.create') }}" class="btn btn-primary">
            + Tambah Rencana
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($plans as $plan)
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">{{ $plan->title }}</h5>
                        <small class="text-muted">{{ ucfirst($plan->category) }} | Target: {{ $plan->target }} | Durasi: {{ $plan->duration }} hari</small>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('ibadah.edit', $plan->id) }}" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                        <form action="{{ route('ibadah.destroy', $plan->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin ingin menghapus rencana ini?')">Hapus</button>
                        </form>
                    </div>
                </div>

                {{-- Form log hari ini --}}
                <form method="POST" action="{{ route('ibadah.log', $plan->id) }}" class="row mt-3 g-2 align-items-center">
                    @csrf
                    <div class="col-md-3">
                        <select name="status" class="form-select" required>
                            <option value="">Status Hari Ini</option>
                            <option value="done">✅ Selesai</option>
                            <option value="missed">❌ Terlewat</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="notes" class="form-control" placeholder="Catatan (optional)">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success w-100">Log Hari Ini</button>
                    </div>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            Belum ada rencana ibadah. Yuk <a href="{{ route('ibadah.create') }}">buat sekarang</a>!
        </div>
    @endforelse

    <div class="text-center mt-4">
        <a href="{{ route('ibadah.progress') }}" class="btn btn-outline-secondary">
            📊 Lihat Progress Ibadah
        </a>
    </div>
</div>
@endsection
