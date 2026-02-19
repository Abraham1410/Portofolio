@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🗂️</div>
        <div class="stat-data">
            <div class="stat-num">{{ $totalProjects }}</div>
            <div class="stat-label">Total Proyek</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">✅</div>
        <div class="stat-data">
            <div class="stat-num">{{ $activeProjects }}</div>
            <div class="stat-label">Proyek Aktif</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">✉️</div>
        <div class="stat-data">
            <div class="stat-num">{{ $totalContacts }}</div>
            <div class="stat-label">Total Pesan</div>
        </div>
    </div>
    <div class="stat-card {{ $unreadContacts > 0 ? 'stat-card-alert' : '' }}">
        <div class="stat-icon">🔔</div>
        <div class="stat-data">
            <div class="stat-num">{{ $unreadContacts }}</div>
            <div class="stat-label">Pesan Belum Dibaca</div>
        </div>
    </div>
</div>

<div class="admin-panels">
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Pesan Terbaru</h2>
            <a href="{{ route('admin.contacts') }}" class="panel-link">Lihat semua →</a>
        </div>
        @forelse($latestContacts as $contact)
        <div class="contact-row {{ !$contact->is_read ? 'unread' : '' }}">
            <div class="contact-row-info">
                <strong>{{ $contact->name }}</strong>
                <span>{{ $contact->email }}</span>
            </div>
            <div class="contact-row-msg">
                {{ Str::limit($contact->message, 60) }}
            </div>
            <div class="contact-row-time">
                {{ $contact->created_at->diffForHumans() }}
            </div>
        </div>
        @empty
        <p class="empty-state">Belum ada pesan masuk.</p>
        @endforelse
    </div>

    <div class="admin-panel">
        <div class="panel-header">
            <h2>Quick Actions</h2>
        </div>
        <div class="quick-actions">
            <a href="{{ route('admin.projects.create') }}" class="qa-btn">
                <span>➕</span>
                Tambah Proyek Baru
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="qa-btn">
                <span>✏️</span>
                Edit Profil
            </a>
            <a href="{{ route('home') }}" target="_blank" class="qa-btn">
                <span>👁️</span>
                Preview Portfolio
            </a>
        </div>
    </div>
</div>
@endsection
