@extends('layouts.admin')
@section('title', 'Edit Profil')

@section('content')
<div class="form-wrap">
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf @method('PUT')

        <div class="form-section">
            <h3>Informasi Dasar</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Jabatan / Title *</label>
                    <input type="text" name="title" value="{{ old('title', $profile->title) }}"
                           placeholder="Full Stack Developer" required>
                </div>
            </div>
            <div class="form-group">
                <label>Tagline *</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}"
                       placeholder="Kalimat singkat tentang kamu" required>
            </div>
            <div class="form-group">
                <label>Tentang Saya *</label>
                <textarea name="about" rows="6" required>{{ old('about', $profile->about) }}</textarea>
            </div>
        </div>

        <div class="form-section">
            <h3>Kontak</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}" required>
                </div>
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                           placeholder="+62 812-xxxx-xxxx">
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                           placeholder="Jakarta, Indonesia">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Social Media</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>GitHub URL</label>
                    <input type="url" name="github" value="{{ old('github', $profile->github) }}">
                </div>
                <div class="form-group">
                    <label>LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}">
                </div>
                <div class="form-group">
                    <label>Instagram URL</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram) }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Skills</h3>
            <div class="form-group">
                <label>Daftar Skill (format: Nama:Level, dipisah koma)</label>
                @php
                    $skillsArray = is_array($profile->skills) ? $profile->skills : json_decode($profile->skills, true);
                @endphp
                <textarea name="skills_input" rows="4" placeholder="Laravel:90, Vue.js:85, MySQL:80, Tailwind:90">{{ old('skills_input', collect($skillsArray)->map(fn($s) => "{$s['name']}:{$s['level']}")->implode(', ')) }}</textarea>
                <small>Contoh: Laravel:90, Vue.js:85, MySQL:80, Tailwind CSS:90</small>
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn-admin btn-admin-primary">💾 Simpan Profil</button>
        </div>
    </form>
</div>
@endsection
