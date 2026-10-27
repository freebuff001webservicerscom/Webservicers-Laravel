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
        <div class="section-head">
          <span class="eyebrow-pill">Benefits</span>
          <h2>{{ $page['perks_title'] }}</h2>
        </div>
        <div class="perks">
          @foreach ($page['perks'] as [$key, $title, $desc])
            <article class="perk" data-reveal>
              <span class="feature-icon">@include('partials.icon', ['name' => $key])</span>
              <h3>{{ $title }}</h3>
              <p>{{ $desc }}</p>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    <section class="content-section content-section--grey">
      <div class="container">
        <div class="section-head section-head--left">
          <span class="eyebrow-pill">Open roles</span>
          <h2>{{ $page['jobs_title'] }}</h2>
          <p>Every role is listed with the team, location and contract type. No mystery applications.</p>
        </div>
        <div class="job-list">
          @foreach ($page['jobs'] as [$title, $team, $loc, $kind])
            <a class="job" href="{{ route('help') }}">
              <div>
                <h3>{{ $title }}</h3>
                <span class="job-team">{{ $team }}</span>
              </div>
              <span class="job-meta">{{ $loc }}</span>
              <span class="job-meta">{{ $kind }}</span>
              <span class="job-arrow">@include('partials.icon', ['name' => 'arrow'])</span>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    @include('partials.cta', [
        'h2' => $page['cta_h2'],
        'copy' => $page['cta_copy'],
        'primaryHref' => route('help'),
        'primaryLabel' => 'Say hello',
    ])
@endsection
