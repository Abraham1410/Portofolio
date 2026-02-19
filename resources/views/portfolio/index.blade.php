@extends('layouts.app')

@section('title', $profile->name)
@section('subtitle', $profile->title)

@section('content')

<!-- ============ HERO ============ -->
<section class="hero" id="home">
    <div class="hero-bg">
        <div class="hero-grain"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>
    </div>

    <div class="hero-inner">
        <div class="hero-badge">
            <span class="badge-dot"></span>
            Available for work
        </div>

        <h1 class="hero-title">
            <span class="hero-greeting">Halo, saya</span>
            <span class="hero-name">{{ $profile->name }}</span>
            <span class="hero-role">{{ $profile->title }}</span>
        </h1>

        <p class="hero-tagline">{{ $profile->tagline }}</p>

        <div class="hero-actions">
            <a href="#projects" class="btn btn-primary">
                Lihat Proyek
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#contact" class="btn btn-ghost">Hubungi Saya</a>
        </div>

        <div class="hero-stats">
            <div class="stat">
                <span class="stat-num">{{ \App\Models\Project::active()->count() }}+</span>
                <span class="stat-label">Proyek</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-num">3+</span>
                <span class="stat-label">Tahun Exp</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-num">100%</span>
                <span class="stat-label">Komitmen</span>
            </div>
        </div>
    </div>

    <div class="hero-scroll">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>


<!-- ============ ABOUT ============ -->
<section class="section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-visual">
                <div class="about-card">
                    <div class="about-avatar">
                        @if($profile->avatar)
                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $profile->name }}">
                        @else
                            <div class="avatar-placeholder">{{ substr($profile->name, 0, 2) }}</div>
                        @endif
                    </div>
                    <div class="about-card-info">
                        <strong>{{ $profile->name }}</strong>
                        <span>{{ $profile->title }}</span>
                    </div>
                    <div class="about-badges">
                        @if($profile->location)
                        <span class="badge">📍 {{ $profile->location }}</span>
                        @endif
                        <span class="badge">✅ Open to Work</span>
                    </div>
                </div>
            </div>

            <div class="about-content">
                <div class="section-label">Tentang Saya</div>
                <h2 class="section-title">Siapa saya<br><em>sebenarnya?</em></h2>
                <p class="about-text">{{ $profile->about }}</p>

                <div class="about-contacts">
                    <a href="mailto:{{ $profile->email }}" class="contact-link">
                        <span class="contact-icon">✉️</span>
                        {{ $profile->email }}
                    </a>
                    @if($profile->phone)
                    <a href="tel:{{ $profile->phone }}" class="contact-link">
                        <span class="contact-icon">📱</span>
                        {{ $profile->phone }}
                    </a>
                    @endif
                </div>

                <div class="about-links">
                    @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank" class="social-link">GitHub</a>
                    @endif
                    @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="social-link">LinkedIn</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============ SERVICES ============ -->
@php $services = is_array($profile->services) ? $profile->services : json_decode($profile->services, true); @endphp
@if($services)
<section class="section section-dark" id="services">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Yang Saya Lakukan</div>
            <h2 class="section-title">Layanan <em>saya</em></h2>
        </div>

        <div class="services-grid">
            @foreach($services as $service)
            <div class="service-card" data-reveal>
                <div class="service-icon">{{ $service['icon'] }}</div>
                <h3>{{ $service['title'] }}</h3>
                <p>{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- ============ SKILLS ============ -->
@php $skills = is_array($profile->skills) ? $profile->skills : json_decode($profile->skills, true); @endphp
@if($skills)
<section class="section" id="skills">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Tech Stack</div>
            <h2 class="section-title">Keahlian <em>saya</em></h2>
        </div>

        <div class="skills-grid">
            @foreach($skills as $skill)
            <div class="skill-item" data-reveal>
                <div class="skill-header">
                    <span class="skill-icon">{{ $skill['icon'] }}</span>
                    <span class="skill-name">{{ $skill['name'] }}</span>
                    <span class="skill-pct">{{ $skill['level'] }}%</span>
                </div>
                <div class="skill-bar">
                    <div class="skill-fill" style="--target: {{ $skill['level'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- ============ PROJECTS ============ -->
<section class="section section-dark" id="projects">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Portofolio</div>
            <h2 class="section-title">Proyek <em>pilihan</em></h2>
        </div>

        <div class="filter-tabs">
            <button class="filter-btn active" data-filter="all">Semua</button>
            @foreach($projects->pluck('category')->unique() as $cat)
                <button class="filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
            @endforeach
        </div>

        <div class="projects-grid" id="projectsGrid">
            @foreach($projects as $project)
            <article class="project-card" data-reveal data-category="{{ Str::slug($project->category) }}">
                <div class="project-image">
                    @if($project->image)
                        <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" alt="{{ $project->title }}" loading="lazy">
                    @else
                        <div class="project-placeholder">
                            <div class="placeholder-grid">
                                <span></span><span></span><span></span><span></span>
                            </div>
                        </div>
                    @endif
                    <div class="project-overlay">
                        <a href="{{ route('project.show', $project->slug) }}" class="overlay-btn">Detail</a>
                        @if($project->url_live)
                        <a href="{{ $project->url_live }}" target="_blank" class="overlay-btn overlay-btn-ghost">Live ↗</a>
                        @endif
                    </div>
                    @if($project->featured)
                    <span class="featured-badge">⭐ Featured</span>
                    @endif
                </div>

                <div class="project-info">
                    <div class="project-meta">
                        <span class="project-cat">{{ $project->category }}</span>
                        @if($project->url_github)
                        <a href="{{ $project->url_github }}" target="_blank" class="project-gh">GitHub →</a>
                        @endif
                    </div>
                    <h3 class="project-title">
                        <a href="{{ route('project.show', $project->slug) }}">{{ $project->title }}</a>
                    </h3>
                    <p class="project-desc">{{ $project->description }}</p>

                    @if($project->tech_stack)
                    <div class="tech-tags">
                        @foreach(is_array($project->tech_stack) ? $project->tech_stack : json_decode($project->tech_stack, true) as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>


<!-- ============ CONTACT ============ -->
<section class="section" id="contact">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <div class="section-label">Kontak</div>
                <h2 class="section-title">Mari <em>bekerja</em><br>sama!</h2>
                <p>Punya project menarik? Atau sekadar ingin ngobrol? Jangan ragu untuk menghubungi saya.</p>

                <div class="contact-items">
                    <a href="mailto:{{ $profile->email }}" class="contact-item">
                        <span class="ci-icon">✉️</span>
                        <span>{{ $profile->email }}</span>
                    </a>
                    @if($profile->phone)
                    <a href="tel:{{ $profile->phone }}" class="contact-item">
                        <span class="ci-icon">📱</span>
                        <span>{{ $profile->phone }}</span>
                    </a>
                    @endif
                    @if($profile->location)
                    <div class="contact-item">
                        <span class="ci-icon">📍</span>
                        <span>{{ $profile->location }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="contact-form-wrap">
                @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
                @endif

                <form class="contact-form" action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama *</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                            @error('email')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Perihal pesan">
                    </div>
                    <div class="form-group">
                        <label>Pesan *</label>
                        <textarea name="message" rows="5" placeholder="Ceritakan project atau pertanyaan kamu..." required>{{ old('message') }}</textarea>
                        @error('message')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        Kirim Pesan
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
