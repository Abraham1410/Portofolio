@extends('layouts.app')

@section('title', $project->title)
@section('subtitle', $project->category)
@section('meta_desc', $project->description)

@section('content')
<div class="project-detail">

    <!-- BREADCRUMB -->
    <div class="breadcrumb-bar">
        <div class="container">
            <a href="{{ route('home') }}">Home</a>
            <span>→</span>
            <a href="{{ route('home') }}#projects">Projects</a>
            <span>→</span>
            <span>{{ $project->title }}</span>
        </div>
    </div>

    <!-- HERO DETAIL -->
    <section class="detail-hero">
        <div class="container">
            <div class="detail-header">
                <span class="project-cat">{{ $project->category }}</span>
                @if($project->featured)
                <span class="featured-badge">⭐ Featured</span>
                @endif
            </div>
            <h1 class="detail-title">{{ $project->title }}</h1>
            <p class="detail-desc">{{ $project->description }}</p>

            <div class="detail-actions">
                @if($project->url_live)
                <a href="{{ $project->url_live }}" target="_blank" class="btn btn-primary">
                    Lihat Live ↗
                </a>
                @endif
                @if($project->url_github)
                <a href="{{ $project->url_github }}" target="_blank" class="btn btn-ghost">
                    Source Code
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- PROJECT IMAGE -->
    @if($project->image)
    <div class="detail-image-wrap">
        <div class="container">
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="detail-image">
        </div>
    </div>
    @endif

    <!-- CONTENT -->
    <section class="detail-content">
        <div class="container">
            <div class="detail-grid">
                <div class="detail-main">
                    @if($project->long_description)
                    <h2>Tentang Proyek</h2>
                    <p>{{ $project->long_description }}</p>
                    @endif
                </div>

                <div class="detail-sidebar">
                    @if($project->tech_stack)
                    <div class="sidebar-card">
                        <h3>Tech Stack</h3>
                        <div class="tech-tags">
                            @foreach($project->tech_stack as $tech)
                            <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="sidebar-card">
                        <h3>Links</h3>
                        @if($project->url_live)
                        <a href="{{ $project->url_live }}" target="_blank" class="sidebar-link">
                            🌐 Live Demo
                        </a>
                        @endif
                        @if($project->url_github)
                        <a href="{{ $project->url_github }}" target="_blank" class="sidebar-link">
                            🐱 GitHub
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RELATED PROJECTS -->
    @if($related->count())
    <section class="detail-related">
        <div class="container">
            <h2>Proyek Lainnya</h2>
            <div class="related-grid">
                @foreach($related as $rel)
                <a href="{{ route('project.show', $rel->slug) }}" class="related-card">
                    <div class="related-cat">{{ $rel->category }}</div>
                    <h3>{{ $rel->title }}</h3>
                    <p>{{ Str::limit($rel->description, 80) }}</p>
                    <span class="related-arrow">→</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="detail-cta">
        <div class="container">
            <h2>Tertarik untuk bekerja sama?</h2>
            <a href="{{ route('home') }}#contact" class="btn btn-primary">Hubungi Saya</a>
        </div>
    </section>
</div>
@endsection
