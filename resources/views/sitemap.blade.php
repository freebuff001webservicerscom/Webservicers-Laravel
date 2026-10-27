@extends('layouts.app')

@section('title', 'Sitemap — WebServicers')
@section('description', 'All pages on the WebServicers website.')
@section('body_class', 'page theme-indigo')

@section('content')
    <section class="simple-hero">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span class="sep">/</span>
          <span class="current">Sitemap</span>
        </nav>
        <span class="eyebrow-pill">Sitemap</span>
        <h1>Every page, one list.</h1>
        <p class="page-lead">A complete map of WebServicers — services, plans, company pages and the legal bits.</p>
      </div>
    </section>

    <section class="content-section">
      <div class="container sitemap-grid">
        <div class="sitemap-card">
          <h2>Services</h2>
          <ul>
            <li><a href="{{ route('page.show', 'website') }}">Website</a></li>
            <li><a href="{{ route('page.show', 'website-design') }}">Website Design</a></li>
            <li><a href="{{ route('page.show', 'seo') }}">SEO Tool</a></li>
            <li><a href="{{ route('page.show', 'google-my-business') }}">Google My Business</a></li>
            <li><a href="{{ route('page.show', 'marketing-analytics') }}">Marketing Analytics</a></li>
            <li><a href="{{ route('page.show', 'google-search-ads') }}">Google Search Ads</a></li>
            <li><a href="{{ route('page.show', 'google-shopping-ads') }}">Google Shopping Ads</a></li>
            <li><a href="{{ route('page.show', 'facebook-ads') }}">Facebook Ads</a></li>
            <li><a href="{{ route('page.show', 'instagram-ads') }}">Instagram Ads</a></li>
          </ul>
        </div>

        <div class="sitemap-card">
          <h2>Company</h2>
          <ul>
            <li><a href="{{ route('contact') }}">Talk to an expert</a></li>
            <li><a href="{{ route('about') }}">About us</a></li>
            <li><a href="{{ route('careers') }}">Careers</a></li>
            <li><a href="{{ route('press') }}">Press &amp; Media</a></li>
            <li><a href="{{ route('help') }}">Help centre</a></li>
            <li><a href="{{ route('pricing') }}">Pricing</a></li>
            <li><a href="{{ route('home') }}">Home</a></li>
          </ul>
        </div>

        <div class="sitemap-card">
          <h2>Legal</h2>
          <ul>
            <li><a href="{{ route('terms') }}">Terms of Service</a></li>
            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
            <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
          </ul>
        </div>
      </div>
    </section>

    @include('partials.cta', [
        'h2' => 'Not sure where to start?',
        'copy' => 'Tell us what your business needs and we will point you to the right service — or tell you honestly that you do not need us yet.',
        'primaryHref' => route('pricing'),
        'primaryLabel' => 'Compare plans',
    ])
@endsection
