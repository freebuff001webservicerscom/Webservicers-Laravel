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

        <form class="help-search" role="search" onsubmit="return false;">
          <label class="sr-only" for="help-q" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)">Search help</label>
          <input id="help-q" type="search" placeholder="Search for an answer — websites, SEO, billing…" />
          <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="section-head section-head--left">
          <span class="eyebrow-pill">Browse</span>
          <h2>Help by topic</h2>
        </div>
        <div class="help-topics">
          @foreach ($page['topics'] as [$key, $title, $desc, $count])
            <a class="help-topic" href="{{ route('help') }}">
              <span class="feature-icon">@include('partials.icon', ['name' => $key])</span>
              <h3>{{ $title }}</h3>
              <p>{{ $desc }}</p>
              <span>{{ $count }} →</span>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <section class="content-section content-section--grey">
      <div class="container">
        <div class="section-head section-head--left">
          <span class="eyebrow-pill">Popular</span>
          <h2>Most read this week</h2>
        </div>
        <div class="article-list">
          @foreach ($page['articles'] as [$title, $meta])
            <a class="article-row" href="{{ route('help') }}">{{ $title }}<span>{{ $meta }}</span></a>
          @endforeach
        </div>
      </div>
    </section>

    @include('partials.cta', [
        'h2' => $page['cta_h2'],
        'copy' => $page['cta_copy'],
        'primaryHref' => route('home') . '#get-started',
        'primaryLabel' => 'Send a message',
    ])
@endsection
