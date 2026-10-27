@extends('layouts.app')

@section('title', $metaTitle)
@section('description', $description)
@section('body_class', 'page ' . $page['theme'])

@section('content')
    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
      <div class="container page-hero-inner">
        <div class="page-hero-copy">
          <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('home') }}#categories">Services</a>
            <span class="sep">/</span>
            <span class="current">{{ $page['crumb'] }}</span>
          </nav>

          <span class="eyebrow-pill eyebrow-pill--dark">{{ $page['eyebrow'] }}</span>
          <h1>{!! $page['h1'] !!}</h1>
          <p class="page-lead">{{ $page['lead'] }}</p>

          <div class="hero-actions">
            <a class="btn btn-lg btn-accent" href="#pricing">See pricing</a>
            <a class="link-arrow" href="{{ route('home') }}#get-started">Talk to an expert</a>
          </div>

          <ul class="hero-points">
            @foreach ($page['points'] as $point)
                <li>{{ $point }}</li>
            @endforeach
          </ul>
        </div>

        <div class="page-hero-visual" aria-hidden="true">
          <span class="hero-float hero-float--a"><strong>{{ $page['float_a'][0] }}</strong><span>{{ $page['float_a'][1] }}</span></span>
          <span class="hero-float hero-float--b"><strong>{{ $page['float_b'][0] }}</strong><span>{{ $page['float_b'][1] }}</span></span>
          @include('partials.mockup', ['name' => $page['visual']])
        </div>
      </div>
    </section>

    <!-- ============ RESULTS ============ -->
    <section class="results">
      <div class="container results-inner">
        <div class="result-panel" data-reveal>
          <div class="gauge" style="--val: {{ $page['results']['gauge'][0] }}%">
            <div class="gauge-inner"><strong>{{ $page['results']['gauge'][0] }}</strong><span>{{ $page['results']['gauge'][1] }}</span></div>
          </div>
          <div class="result-tags">
            @foreach ($page['results']['tags'] as $tag)
                <span>{{ $tag }}</span>
            @endforeach
          </div>
          <div class="result-foot">
            <span>{{ $page['results']['foot'][0] }}</span>
            <strong>{{ $page['results']['foot'][1] }}</strong>
            <em>{{ $page['results']['foot'][2] }}</em>
          </div>
        </div>

        <div class="results-copy" data-reveal>
          <span class="eyebrow-pill">Results</span>
          <h2>{{ $page['results']['h2'] }}</h2>
          <p>{{ $page['results']['copy'] }}</p>
          <ul class="check-list">
            @foreach ($page['results']['checks'] as $check)
                <li>{{ $check }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>

    <!-- ============ PRICING ============ -->
    <section class="pricing" id="pricing">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow-pill">Pricing</span>
          <h2>{{ $page['pricing']['h2'] }}</h2>
          <p>{{ $page['pricing']['copy'] }}</p>
        </div>

        <div class="price-grid">
            @foreach ($page['pricing']['tiers'] as $key => $tier)
                <article class="price-card{{ $key === 1 ? ' price-card--featured' : '' }}">
                    @if ($key === 1)<span class="price-ribbon">Most popular</span>@endif
                    <p class="price-name">{{ $tier['name'] }}</p>
                    <p class="price-amount">{{ $tier['price'] }}<small>{{ $tier['period'] }}</small></p>
                    <p class="price-note">{{ $tier['note'] }}</p>
                    <ul class="price-list">
                        @foreach ($tier['features'] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    <a class="btn {{ $key === 1 ? 'btn-primary' : 'btn-outline' }}" href="{{ route('home') }}#get-started">{{ $tier['cta'] }}</a>
                </article>
            @endforeach
        </div>

        <div class="enterprise">
          <div>
            <h3>Enterprise</h3>
            <p>{{ $page['pricing']['enterprise']['note'] }}</p>
          </div>
          <ul>
            @foreach ($page['pricing']['enterprise']['bullets'] as $bullet)
                <li>{{ $bullet }}</li>
            @endforeach
          </ul>
          <a class="btn btn-white" href="{{ route('home') }}#get-started">{{ $page['pricing']['enterprise']['cta'] }}</a>
        </div>

        <p class="pricing-note">All plans exclude ad spend. No setup fees, no lock-in. <a href="{{ route('home') }}#faq">Questions about billing?</a></p>
      </div>
    </section>

    <!-- ============ FEATURES ============ -->
    <section class="features">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow-pill">{{ $page['features']['eyebrow'] }}</span>
          <h2>{{ $page['features']['h2'] }}</h2>
          <p>{{ $page['features']['copy'] }}</p>
        </div>

        <div class="feature-grid">
            @foreach ($page['features']['items'] as $item)
                <article class="feature" data-reveal>
                    <span class="feature-icon">@include('partials.icon', ['name' => $item[0]])</span>
                    <h3>{{ $item[1] }}</h3>
                    <p>{{ $item[2] }}</p>
                </article>
            @endforeach
        </div>
      </div>
    </section>

    <!-- ============ SHOWCASE ============ -->
    <section class="showcase">
      <div class="container">
        <div class="showcase-panel">
          <div class="showcase-copy" data-reveal>
            <span class="eyebrow-pill">{{ $page['showcase']['eyebrow'] }}</span>
            <h2>{{ $page['showcase']['h2'] }}</h2>
            <p>{{ $page['showcase']['copy'] }}</p>
            <ul>
                @foreach ($page['showcase']['bullets'] as $bullet)
                    <li>{{ $bullet }}</li>
                @endforeach
            </ul>
            @if (!empty($page['showcase']['link']))
                <a class="link-arrow link-arrow--dark" href="{{ route('page.show', ['slug' => preg_replace('/\.html$/', '', $page['showcase']['link'])]) }}">{{ $page['showcase']['link_label'] }}</a>
            @endif
          </div>
          <div class="showcase-visual" data-reveal>
            @include('partials.mockup', ['name' => $page['showcase']['visual']])
          </div>
        </div>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="faq svc-faq" id="faq">
      <div class="container faq-grid">
        <div class="faq-intro">
          <span class="eyebrow-pill">Good to know</span>
          <h2>Questions,<br />answered</h2>
          <p>Everything clients ask before starting {{ $page['crumb'] }}.</p>
          <div class="help-card">
            <div class="help-avatars" aria-hidden="true"><span>SC</span><span>TH</span><span>SM</span></div>
            <div>
              <strong>Still curious?</strong>
              <a class="link-arrow link-arrow--dark" href="{{ route('home') }}#faq">Visit the help centre</a>
            </div>
          </div>
        </div>

        <div class="faq-list">
            @foreach ($page['faq'] as $index => [$question, $answer])
                <details class="faq-item" @if($index === 0) open @endif>
                    <summary>{{ $question }}<span class="faq-plus" aria-hidden="true"></span></summary>
                    <div class="faq-answer"><p>{{ $answer }}</p></div>
                </details>
            @endforeach
        </div>
      </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="cta" id="get-started">
      <div class="container">
        <div class="cta-card" data-reveal>
          <span class="cta-spark cta-spark--1" aria-hidden="true">✦</span>
          <span class="cta-spark cta-spark--2" aria-hidden="true">✦</span>
          <div class="cta-copy">
            <span class="eyebrow-pill eyebrow-pill--dark">Let's go</span>
            <h2>{{ $page['cta']['h2'] }}</h2>
            <p>{{ $page['cta']['copy'] }}</p>
          </div>
          <div class="cta-actions">
            <a class="btn btn-light btn-lg" href="{{ $page['cta']['primary'] }}">{{ $page['cta']['primary_label'] }}</a>
            <a class="btn btn-glass btn-lg" href="{{ route('home') }}#get-started">Talk to an expert</a>
          </div>
        </div>
      </div>
    </section>
@endsection
