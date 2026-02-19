@extends('layouts.admin')
@section('title', 'Projects')

@section('content')
<div class="page-actions">
    <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-admin-primary">
        ➕ Tambah Project
    </a>
</div>

<div class="admin-table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $i => $project)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="table-thumb" alt="">
                    @else
                        <div class="table-thumb-placeholder">🖼️</div>
                    @endif
                </td>
                <td>
                    <strong>{{ $project->title }}</strong>
                    <br><small>{{ Str::limit($project->description, 60) }}</small>
                </td>
                <td><span class="badge-category">{{ $project->category }}</span></td>
                <td>
                    <span class="status-badge {{ $project->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $project->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>{{ $project->featured ? '⭐' : '—' }}</td>
                <td>
                    <div class="table-actions">
                        <a href="{{ route('project.show', $project->slug) }}" target="_blank" class="ta-btn">Lihat</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="ta-btn ta-btn-edit">Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Yakin hapus proyek ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="ta-btn ta-btn-delete">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="empty-state">Belum ada proyek. <a href="{{ route('admin.projects.create') }}">Tambah sekarang →</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
