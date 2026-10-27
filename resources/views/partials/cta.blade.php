{{-- Shared closing CTA card — matches the reference cta_block(). --}}
<section class="cta">
  <div class="container">
    <div class="cta-card" data-reveal>
      <span class="cta-spark cta-spark--1" aria-hidden="true">✦</span>
      <span class="cta-spark cta-spark--2" aria-hidden="true">✦</span>
      <div class="cta-copy">
        <span class="eyebrow-pill eyebrow-pill--dark">Let's go</span>
        <h2>{{ $h2 }}</h2>
        <p>{{ $copy }}</p>
      </div>
      <div class="cta-actions">
        <a class="btn btn-light btn-lg" href="{{ $primaryHref }}">{{ $primaryLabel }}</a>
        <a class="btn btn-glass btn-lg" href="{{ route('contact') }}">Talk to an expert</a>
      </div>
    </div>
  </div>
</section>
