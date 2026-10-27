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
      <div class="container legal-layout">
        <aside class="legal-toc" aria-label="On this page">
          <p>On this page</p>
          <ol>
            @foreach ($page['sections'] as [$title, $paragraphs])
              <li><a href="#s{{ $loop->iteration }}">{{ $title }}</a></li>
            @endforeach
          </ol>
        </aside>

        <div class="prose">
          <span class="legal-updated">{{ $page['updated'] }}</span>
          <div class="notice">This is a demonstration document for the WebServicers website. It is not legal advice. Have your own terms reviewed before you use them with clients.</div>

          @foreach ($page['sections'] as [$title, $paragraphs])
            <h2 id="s{{ $loop->iteration }}">{{ $title }}</h2>
            @foreach ($paragraphs as $paragraph)
              @if (str_starts_with($paragraph, '- '))
                <ul><li>{{ substr($paragraph, 2) }}</li></ul>
              @else
                <p>{{ $paragraph }}</p>
              @endif
            @endforeach
          @endforeach
        </div>
      </div>
    </section>
@endsection
