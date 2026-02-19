<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-body">

<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="sidebar-logo">
            <span class="logo-icon">⚡</span>
            <span>Admin Panel</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <span>🗂️</span> Projects
            </a>
            <a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                <span>✉️</span> Pesan Masuk
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <span>👤</span> Edit Profil
            </a>
            <div class="sidebar-divider"></div>
            <a href="{{ route('home') }}" target="_blank">
                <span>🌐</span> Lihat Portfolio
            </a>
            <div class="sidebar-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <span>🚪</span> Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- MAIN -->
    <div class="admin-main">
        <header class="admin-header">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="admin-user">
                <span>Admin</span>
            </div>
        </header>

        <div class="admin-content">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
