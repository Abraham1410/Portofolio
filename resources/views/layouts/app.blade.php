<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $profile->name ?? 'Portfolio') — @yield('subtitle', 'Developer')</title>
    <meta name="description" content="@yield('meta_desc', $profile->tagline ?? 'Portfolio Developer')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/portfolio.css">

    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text">{{ substr($profile->name ?? 'Dev', 0, 1) }}</span>
                <span class="logo-dot"></span>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}#about">Tentang</a></li>
                <li><a href="{{ route('home') }}#skills">Keahlian</a></li>
                <li><a href="{{ route('home') }}#projects">Proyek</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
            </ul>

            <a href="{{ route('home') }}#contact" class="nav-cta">
                Hire Me
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>

            <button class="nav-toggle" id="navToggle">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-inner">
            <p class="footer-copy">
                © {{ date('Y') }} {{ $profile->name ?? 'Developer' }}.
            </p>
            <div class="footer-socials">
                @if($profile->github ?? false)
                    <a href="{{ $profile->github }}" target="_blank" rel="noopener">GitHub</a>
                @endif
                @if($profile->linkedin ?? false)
                    <a href="{{ $profile->linkedin }}" target="_blank" rel="noopener">LinkedIn</a>
                @endif
                @if($profile->instagram ?? false)
                    <a href="{{ $profile->instagram }}" target="_blank" rel="noopener">Instagram</a>
                @endif
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="{{ asset('js/portfolio.js') }}"></script>
    @stack('scripts')
</body>
</html>
