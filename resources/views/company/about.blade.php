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

        <div class="stat-strip">
          @foreach ($page['stats'] as [$value, $label])
            <div><strong>{{ $value }}</strong><span>{{ $label }}</span></div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container story-grid">
        <div class="story-copy" data-reveal>
          <span class="eyebrow-pill">Our story</span>
          <h2>{{ $page['story_title'] }}</h2>
          @foreach ($page['story'] as $paragraph)
            <p>{{ $paragraph }}</p>
          @endforeach
          <a class="btn btn-outline" href="{{ route('careers') }}">Come work with us</a>
        </div>

        <div class="story-art" data-reveal aria-hidden="true">
          <div class="story-tile story-tile--a">
            <div class="t-kicker">Client results</div>
            <div class="t-big">+128%</div>
            <div class="t-small">organic traffic in 6 months</div>
            <div class="t-bars"><i></i><i></i><i></i><i></i><i></i></div>
          </div>
          <div class="story-tile story-tile--b">
            <div class="t-kicker">The team</div>
            <div class="story-avatars"><span>MC</span><span>JB</span><span>PR</span><span>SO</span></div>
            <div class="t-small" style="margin-top:8px">38 specialists, 6 countries</div>
          </div>
          <div class="story-tile story-tile--c">
            <div class="t-kicker">Since 2016</div>
            <div class="t-big">212</div>
            <div class="t-small">businesses launched</div>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section content-section--cream">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow-pill">Values</span>
          <h2>{{ $page['values_title'] }}</h2>
        </div>
        <div class="value-grid">
          @foreach ($page['values'] as [$key, $title, $desc])
            <article class="value-card" data-reveal>
              <span class="feature-icon">@include('partials.icon', ['name' => $key])</span>
              <h3>{{ $title }}</h3>
              <p>{{ $desc }}</p>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow-pill">Team</span>
          <h2>{{ $page['team_title'] }}</h2>
        </div>
        <div class="team-grid">
          @foreach ($page['team'] as [$name, $role, $bio, $initials])
            <article class="team-card" data-reveal>
              <div class="team-avatar">{{ $initials }}</div>
              <h3>{{ $name }}</h3>
              <p>{{ $role }}</p>
              <p class="team-quote">{{ $bio }}</p>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    @include('partials.cta', [
        'h2' => $page['cta_h2'],
        'copy' => $page['cta_copy'],
        'primaryHref' => route('pricing'),
        'primaryLabel' => 'See plans',
    ])
@endsection
