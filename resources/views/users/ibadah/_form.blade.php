@csrf

@if (isset($isEdit) && $isEdit)
    @method('PUT')
@endif

<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $plan->title ?? '') }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category" class="form-label">Kategori</label>
    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
           placeholder="Contoh: Sholat, Puasa, dll"
           value="{{ old('category', $plan->category ?? '') }}" required>
    @error('category')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="target" class="form-label">Target</label>
    <input type="number" name="target" class="form-control @error('target') is-invalid @enderror"
           value="{{ old('target', $plan->target ?? '') }}" required>
    @error('target')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="duration" class="form-label">Durasi (hari)</label>
    <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror"
           value="{{ old('duration', $plan->duration ?? '') }}" required>
    @error('duration')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-between mt-4">
    <a href="{{ route('ibadah.index') }}" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">
        {{ isset($isEdit) && $isEdit ? 'Update' : 'Simpan' }}
    </button>
</div>