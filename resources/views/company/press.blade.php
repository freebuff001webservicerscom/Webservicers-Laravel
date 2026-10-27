@extends('layouts.app')

@section('title', $metaTitle)
@section('description', $description)
@section('body_class', 'page ' . $theme)

@section('content')
    <section class="simple-hero">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span class="sep">/</span>
          <span class="current">{{ $page['eyebrow'] }}</span>
        </nav>
        <span class="eyebrow-pill">{{ $page['eyebrow'] }}</span>
        <h1>{{ $page['h1'] }}</h1>
        <p class="page-lead">{{ $page['lead'] }}</p>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="section-head section-head--left">
          <span class="eyebrow-pill">Latest news</span>
          <h2>Press releases</h2>
        </div>
        <div class="press-list">
          @foreach ($page['releases'] as [$date, $title, $body])
            <article class="press-item">
              <span class="press-date">{{ $date }}</span>
              <div>
                <h3>{{ $title }}</h3>
                <p>{{ $body }}</p>
              </div>
              <a class="press-link" href="{{ route('help') }}">Read more @include('partials.icon', ['name' => 'arrow'])</a>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    <section class="content-section content-section--cream">
      <div class="container">
        <div class="section-head section-head--left">
          <span class="eyebrow-pill">Brand assets</span>
          <h2>Everything you need for the story</h2>
          <p>Please do not alter the logo, change the brand colours or crop team photography without checking with us first.</p>
        </div>
        <div class="asset-grid">
          <article class="asset-card">
            <div class="asset-swatch"><svg viewBox="0 0 40 40" fill="none" aria-hidden="true"><path d="M9.5 13.2 14.9 26.8 20 17.6 25.1 26.8 30.5 13.2" stroke="#fff" stroke-width="3.1" stroke-linecap="round" stroke-linejoin="round"/><circle cx="34.6" cy="7.6" r="2.2" fill="#E4FF6A"/></svg><b>WebServicers</b></div>
            <h3>Logo pack</h3>
            <p>The Signal W mark and WebServicers lockup in SVG.</p>
            <a href="/assets/img/logo.svg">Download ↗</a>
          </article>
          <article class="asset-card">
            <div class="asset-swatch"><i style="background:#0b7a53"></i><i style="background:#ff8a5b"></i><i style="background:#e4ff6a"></i></div>
            <h3>Brand colours</h3>
            <p>Palette values and accessible pairings for print and screen.</p>
            <a href="{{ route('home') }}">Download ↗</a>
          </article>
          <article class="asset-card">
            <div class="asset-swatch asset-swatch--photo"><i></i><i></i><i></i></div>
            <h3>Team photography</h3>
            <p>Approved portraits and office imagery for editorial use.</p>
            <a href="{{ route('home') }}">Download ↗</a>
          </article>
        </div>
      </div>
    </section>

    @include('partials.cta', [
        'h2' => $page['cta_h2'],
        'copy' => $page['cta_copy'],
        'primaryHref' => route('help'),
        'primaryLabel' => 'Contact the press team',
    ])
@endsection
