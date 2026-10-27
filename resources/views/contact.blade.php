@extends('layouts.app')

@section('title', 'Talk to an expert — WebServicers')
@section('description', 'Get in touch with WebServicers — fill out the form to request a call back about your website, SEO or advertising.')
@section('body_class', 'page theme-indigo')

@section('content')
    <section class="simple-hero">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span class="sep">/</span>
          <span class="current">Talk to an expert</span>
        </nav>
        <span class="eyebrow-pill">Contact</span>
        <h1>Talk to an expert</h1>
        <p class="page-lead">Get in touch with us — fill out the form to request a call back and we will tell you what we would actually do, usually within one working day.</p>
      </div>
    </section>

    <section class="content-section">
      <div class="container contact-grid">

        <div class="contact-card" data-reveal>
          <h2>Request a call back</h2>
          <p class="contact-lead">Tell us a little about your business and what you need. No sales script — just a straight answer.</p>

          <form class="contact-form" method="post" action="{{ route('contact.store') }}" data-feedback="Thanks — your message is with us. We usually reply within one working day.">
            @csrf
            <div class="field-row">
              <div class="field">
                <label for="contact-name">Full name *</label>
                <input id="contact-name" name="name" type="text" autocomplete="name" placeholder="Alex Morgan" required>
              </div>
              <div class="field">
                <label for="contact-email">Email Address *</label>
                <input id="contact-email" name="email" type="email" autocomplete="email" placeholder="you@business.com" required>
              </div>
            </div>

            <div class="field-row">
              <div class="field">
                <label for="contact-phone">Phone (optional)</label>
                <input id="contact-phone" name="phone" type="tel" autocomplete="tel" placeholder="+1 555 000 0000">
              </div>
              <div class="field">
                <label for="contact-service">What do you need?</label>
                <select id="contact-service" name="service">
                  <option>Not sure yet — advise me</option>
                  <option>Website</option>
                  <option>Website Design</option>
                  <option>SEO Tool</option>
                  <option>Google My Business</option>
                  <option>Marketing Analytics</option>
                  <option>Google Search Ads</option>
                  <option>Google Shopping Ads</option>
                  <option>Facebook Advertising</option>
                  <option>Instagram Advertising</option>
                </select>
              </div>
            </div>

            <div class="field">
              <label for="contact-message">Message *</label>
              <textarea id="contact-message" name="message" rows="5" placeholder="A sentence or two about your business and what you are trying to achieve." required></textarea>
            </div>

            <button class="btn btn-primary btn-lg contact-submit" type="submit">Request a call back</button>
            <p class="contact-feedback" role="status" @unless(session('contact_sent')) hidden @endunless>{{ session('contact_sent') }}</p>
          </form>

          <p class="contact-legal">By sending this you agree to our <a href="{{ route('terms') }}">Terms of Service</a> and <a href="{{ route('privacy') }}">Privacy Policy</a>.</p>
        </div>

        <aside class="contact-aside" aria-label="What happens next">
          <span class="eyebrow-pill eyebrow-pill--dark">Good to know</span>
          <h2>What happens after you send it</h2>
          <p>No auto-responder maze — a real person reads what you wrote and replies.</p>
          <ul class="contact-points">
            <li><strong>We reply within one working day</strong><span>Write in the morning and you will usually hear back the same afternoon.</span></li>
            <li><strong>You get a straight answer</strong><span>What it costs, how long it takes, and whether you need us at all.</span></li>
            <li><strong>Prefer to talk it through?</strong><span>Leave your number and a good time in the form — we will ring you.</span></li>
          </ul>
          <div class="contact-alt">
            <p>Already a customer? The Help centre answers the common stuff.</p>
            <a class="btn btn-white btn-sm" href="{{ route('help') }}">Visit the Help centre</a>
          </div>
        </aside>

      </div>
    </section>
@endsection
