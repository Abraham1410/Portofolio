@extends('layouts.admin')
@section('title', isset($project) ? 'Edit Project' : 'Tambah Project')

@section('content')
<div class="form-wrap">
    <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($project)) @method('PUT') @endif

        <div class="form-grid">
            <!-- KIRI -->
            <div class="form-col">
                <div class="form-group">
                    <label>Judul Project *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}"
                           placeholder="Nama project kamu" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi Singkat *</label>
                    <textarea name="description" rows="3" placeholder="Ringkasan singkat project..." required>{{ old('description', $project->description ?? '') }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi Lengkap</label>
                    <textarea name="long_description" rows="6" placeholder="Ceritakan lebih detail tentang project ini...">{{ old('long_description', $project->long_description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Kategori *</label>
                    <input type="text" name="category" value="{{ old('category', $project->category ?? '') }}"
                           placeholder="Contoh: Web App, Mobile App, Design" required>
                </div>

                <div class="form-group">
                    <label>Tech Stack</label>
                    <input type="text" name="tech_stack_input"
                           value="{{ old('tech_stack_input', isset($project) ? implode(', ', $project->tech_stack ?? []) : '') }}"
                           placeholder="Laravel, Vue.js, MySQL (pisah dengan koma)">
                    <small>Pisahkan dengan koma. Contoh: Laravel, Vue.js, Tailwind CSS</small>
                </div>
            </div>

            <!-- KANAN -->
            <div class="form-col">
                <div class="form-group">
                    <label>Gambar / Screenshot</label>
                    @if(isset($project) && $project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="" class="preview-image">
                        <small>Upload baru untuk mengganti gambar</small>
                    @endif
                    <input type="file" name="image" accept="image/*" id="imageInput">
                    <div class="image-preview-wrap" id="imagePreview"></div>
                </div>

                <div class="form-group">
                    <label>URL Live Demo</label>
                    <input type="url" name="url_live" value="{{ old('url_live', $project->url_live ?? '') }}"
                           placeholder="https://example.com">
                </div>

                <div class="form-group">
                    <label>URL GitHub</label>
                    <input type="url" name="url_github" value="{{ old('url_github', $project->url_github ?? '') }}"
                           placeholder="https://github.com/username/repo">
                </div>

                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}" min="0">
                </div>

                <div class="form-checkboxes">
                    <label class="checkbox-label">
                        <input type="checkbox" name="featured" value="1"
                               {{ old('featured', $project->featured ?? false) ? 'checked' : '' }}>
                        <span>⭐ Tampilkan sebagai Featured</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}>
                        <span>✅ Project Aktif (tampil di portfolio)</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('admin.projects.index') }}" class="btn-admin">← Kembali</a>
            <button type="submit" class="btn-admin btn-admin-primary">
                {{ isset($project) ? '💾 Simpan Perubahan' : '➕ Tambah Project' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
        document.getElementById('imagePreview').innerHTML =
            `<img src="${ev.target.result}" style="max-width:100%;border-radius:8px;margin-top:8px;">`;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
