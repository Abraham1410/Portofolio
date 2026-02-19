@extends('layouts.admin')
@section('title', 'Pesan Masuk')

@section('content')
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Subject</th>
                <th>Pesan</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
            <tr class="{{ !$contact->is_read ? 'row-unread' : '' }}">
                <td>
                    <strong>{{ $contact->name }}</strong>
                    <br><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </td>
                <td>{{ $contact->subject ?: '—' }}</td>
                <td class="message-cell">{{ $contact->message }}</td>
                <td>{{ $contact->created_at->format('d M Y H:i') }}</td>
                <td>
                    <span class="{{ $contact->is_read ? 'status-badge status-active' : 'status-badge status-inactive' }}">
                        {{ $contact->is_read ? 'Dibaca' : 'Baru' }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-state">Belum ada pesan masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
