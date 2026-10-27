@extends('layouts.app')

@section('title', 'Pricing — WebServicers')
@section('description', 'Plans and pricing for websites, SEO, advertising, local listings and analytics.')
@section('body_class', 'page theme-indigo')

@section('content')
    <section class="simple-hero simple-hero--center">
      <div class="container">
        <span class="eyebrow-pill">Pricing</span>
        <h1>Simple plans for every service.</h1>
        <p class="page-lead">One price per service, billed monthly, with the work and the reporting included. No setup fees, no percentage of your ad spend, no&nbsp;lock&#8209;in.</p>
      </div>
    </section>

    <section class="content-section">
      <div class="container">
        <div class="plan-grid">
          @foreach ($plans as $plan)
            <article class="plan-card {{ $plan['theme'] }}" data-reveal>
              <span class="plan-icon">@include('partials.icon', ['name' => $plan['icon']])</span>
              <h3>{{ $plan['label'] }}</h3>
              <p>{{ $plan['tag'] }} · three plans</p>
              <p class="plan-price">{{ $plan['price'] }}<small>/mo</small></p>
              <a class="plan-link" href="{{ route('page.show', $plan['slug']) }}#pricing">View plans @include('partials.icon', ['name' => 'arrow'])</a>
            </article>
          @endforeach
        </div>

        <div class="plan-includes" data-reveal>
          <p class="plan-includes-title">Included in every plan</p>
          <ul>
            <li><strong>A named specialist</strong><span>One person who knows your account and answers the same day.</span></li>
            <li><strong>Monthly reporting</strong><span>A short written report: what changed, what we did next.</span></li>
            <li><strong>No lock-in</strong><span>Monthly billing. Pause or cancel with 30 days' notice.</span></li>
            <li><strong>We never take a cut</strong><span>No percentage of ad spend, no setup fee, no surprises.</span></li>
          </ul>
        </div>

        <p class="pricing-note">All plans exclude advertising spend. Enterprise pricing is quoted per scope — <a href="{{ route('help') }}">talk to us</a>.</p>
      </div>
    </section>

    @include('partials.cta', [
        'h2' => 'Not sure which plan fits?',
        'copy' => 'Tell us your goals and budget. We will recommend the smallest plan that can get you there — and say so if you need less.',
        'primaryHref' => route('help'),
        'primaryLabel' => 'Ask an expert',
    ])
@endsection
