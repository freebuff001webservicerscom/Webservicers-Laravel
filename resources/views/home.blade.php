@extends('layouts.app')

@section('content')
    <!-- ============ HERO ============ -->
    <section class="hero" id="hero">
      <div class="hero-glow hero-glow--coral" aria-hidden="true"></div>
      <div class="hero-glow hero-glow--blue" aria-hidden="true"></div>
      <div class="hero-grain" aria-hidden="true"></div>

      <div class="container hero-inner">
        <div class="hero-copy">
          <span class="eyebrow-pill eyebrow-pill--dark">
            <span class="eyebrow-dot" aria-hidden="true"></span>
            Websites · SEO · Paid social
          </span>

          <h1>Make Your Business<br /><span class="grad">Online</span></h1>
          <p class="lead">Let Our Experts Build Your Website</p>
          <p class="hero-copy">We're here to build a premium site that reflects your brand and exceeds your expectations.</p>

          <div class="hero-actions">
            <a class="btn btn-light btn-lg" href="#get-started">
              Get Started
              <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <a class="link-arrow" href="#services">Explore marketing services</a>
          </div>

          <ul class="hero-points">
            <li>No agency middleman</li>
            <li>Live in 7 days</li>
            <li>Cancel anytime</li>
          </ul>
        </div>

        <div class="hero-visual" aria-hidden="true">
          <div class="studio-card">
            <div class="studio-head">
              <span class="studio-dots"><i></i><i></i><i></i></span>
              <span class="studio-url">webservicers.com</span>
              <span class="live-pill"><i></i> Live</span>
            </div>

            <div class="studio-body">
              <div class="studio-metric">
                <p class="studio-label">Visitors this month</p>
                <p class="studio-value">24,861 <span class="delta">+38%</span></p>
              </div>

              <svg class="studio-chart" viewBox="0 0 460 130" preserveAspectRatio="none">
                <defs>
                  <linearGradient id="chartFill" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0" stop-color="#7fdcc0" stop-opacity=".45"/>
                    <stop offset="1" stop-color="#7fdcc0" stop-opacity="0"/>
                  </linearGradient>
                </defs>
                <g stroke="rgba(255,255,255,.12)" stroke-width="1">
                  <line x1="0" y1="34" x2="460" y2="34"/>
                  <line x1="0" y1="70" x2="460" y2="70"/>
                  <line x1="0" y1="106" x2="460" y2="106"/>
                </g>
                <path d="M0 108 L58 92 L116 100 L174 70 L232 78 L290 50 L348 58 L406 30 L460 16 L460 130 L0 130 Z" fill="url(#chartFill)"/>
                <path d="M0 108 L58 92 L116 100 L174 70 L232 78 L290 50 L348 58 L406 30 L460 16" fill="none" stroke="#b7e8d6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="460" cy="16" r="4.5" fill="#e4ff6a" stroke="#082018" stroke-width="2"/>
              </svg>

              <div class="channels">
                <div class="channel">
                  <span class="channel-dot channel-dot--google"></span>
                  <span class="channel-name">Google Ads</span>
                  <span class="channel-bar"><i style="width:78%"></i></span>
                  <span class="channel-val">42%</span>
                </div>
                <div class="channel">
                  <span class="channel-dot channel-dot--meta"></span>
                  <span class="channel-name">Meta Ads</span>
                  <span class="channel-bar"><i style="width:56%"></i></span>
                  <span class="channel-val">31%</span>
                </div>
                <div class="channel">
                  <span class="channel-dot channel-dot--seo"></span>
                  <span class="channel-name">Organic SEO</span>
                  <span class="channel-bar"><i style="width:44%"></i></span>
                  <span class="channel-val">27%</span>
                </div>
              </div>
            </div>
          </div>

          <div class="float-card float-card--traffic">
            <span class="float-icon float-icon--lime">
              <svg viewBox="0 0 20 20"><path d="M4 14l4-4 3 2.5L15 7" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.5 7H15v3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span class="float-text"><strong>+64%</strong> organic traffic</span>
          </div>

          <div class="float-card float-card--lead">
            <span class="float-avatar">SC</span>
            <span class="float-text"><strong>New lead</strong> Sarah booked a call</span>
          </div>

        </div>
      </div>

      <div class="hero-marquee" aria-hidden="true">
        <div class="marquee-track">
          <div class="marquee-group">
            <span>Website design</span><i>✦</i><span>SEO</span><i>✦</i><span>Google Ads</span><i>✦</i><span>Facebook Ads</span><i>✦</i><span>Instagram Ads</span><i>✦</i><span>TikTok Ads</span><i>✦</i><span>LinkedIn Ads</span><i>✦</i><span>Google My Business</span><i>✦</i>
          </div>
          <div class="marquee-group">
            <span>Website design</span><i>✦</i><span>SEO</span><i>✦</i><span>Google Ads</span><i>✦</i><span>Facebook Ads</span><i>✦</i><span>Instagram Ads</span><i>✦</i><span>TikTok Ads</span><i>✦</i><span>LinkedIn Ads</span><i>✦</i><span>Google My Business</span><i>✦</i>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ CATEGORIES ============ -->
    <section class="categories" id="categories" aria-labelledby="categories-title">
      <div class="container">
        <div class="section-head section-head--left">
          <span class="eyebrow-pill">Our Marketing &amp; Services Categories</span>
          <h2 id="categories-title">Every channel your<br /> business needs. <span class="squiggle">One team.</span></h2>
          <p>Pick a service or hand us the whole growth plan — we handle the rest.</p>
        </div>

        <div class="cat-grid">
          <a class="cat-card cat-card--youtube" href="#services">
            <span class="cat-index">01</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81ZM9.55 15.57V8.43L15.82 12l-6.27 3.57Z"/></svg>
            </span>
            <span class="cat-name">YouTube marketing</span>
            <span class="cat-desc">Video ads &amp; channel growth</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--facebook" href="{{ route('page.show', 'facebook-ads') }}">
            <span class="cat-index">02</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M24 12.07C24 5.44 18.63.07 12 .07S0 5.44 0 12.07c0 5.99 4.39 10.95 10.13 11.85v-8.38H7.08v-3.47h3.05V9.43c0-3.01 1.79-4.67 4.53-4.67 1.31 0 2.69.24 2.69.24v2.95h-1.51c-1.49 0-1.96.93-1.96 1.88v2.25h3.33l-.53 3.47h-2.8v8.38C19.61 23.02 24 18.06 24 12.07Z"/></svg>
            </span>
            <span class="cat-name">Facebook marketing</span>
            <span class="cat-desc">Pages, posts &amp; paid reach</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--instagram" href="{{ route('page.show', 'instagram-ads') }}">
            <span class="cat-index">03</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2.4" y="2.4" width="19.2" height="19.2" rx="5.6" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4.4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.4" cy="6.6" r="1.3" fill="currentColor"/></svg>
            </span>
            <span class="cat-name">Instagram marketing</span>
            <span class="cat-desc">Reels, stories &amp; shopping</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--twitter" href="#services">
            <span class="cat-index">04</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M23.95 4.57a10 10 0 0 1-2.82.78 4.96 4.96 0 0 0 2.16-2.73c-.95.56-2 .96-3.13 1.19a4.92 4.92 0 0 0-8.38 4.48A13.97 13.97 0 0 1 1.64 3.16a4.82 4.82 0 0 0-.67 2.48c0 1.71.87 3.21 2.19 4.1a4.9 4.9 0 0 1-2.23-.62v.06a4.92 4.92 0 0 0 3.95 4.83 4.99 4.99 0 0 1-2.22.08 4.94 4.94 0 0 0 4.6 3.42A9.87 9.87 0 0 1 .16 19.6c-.39 0-.78-.02-1.16-.07a13.99 13.99 0 0 0 7.56 2.21c9.05 0 14-7.5 14-13.99 0-.21 0-.42-.02-.63a9.94 9.94 0 0 0 2.45-2.55Z"/></svg>
            </span>
            <span class="cat-name">Twitter Marketing</span>
            <span class="cat-desc">Conversation-led campaigns</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--design" href="{{ route('page.show', 'website-design') }}">
            <span class="cat-index">05</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2.5" y="3.5" width="19" height="17" rx="2.6" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M2.5 8.6h19M8.6 8.6v11.9" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
            </span>
            <span class="cat-body">
              <span class="cat-kicker">Premium service</span>
              <span class="cat-name">Website Design</span>
              <span class="cat-desc">Premium sites, built fast</span>
              <span class="cat-promo">Let our premium team build your website</span>
            </span>
            <span class="cat-cta">Hire Us</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--seo" href="{{ route('page.show', 'seo') }}">
            <span class="cat-index">06</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.5" cy="10.5" r="7" fill="none" stroke="currentColor" stroke-width="2"/><path d="M15.6 15.6 21 21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M7.4 12.4V9.9M10.5 12.4V7.6M13.6 12.4v-2.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <span class="cat-name">Website SEO</span>
            <span class="cat-desc">Rank higher on Google</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--tiktok" href="#services">
            <span class="cat-index">07</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12.53.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03C3.22 21.77 1.8 19.59 1.59 17.25c-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07Z"/></svg>
            </span>
            <span class="cat-name">TikTok marketing</span>
            <span class="cat-desc">Short-form video ads</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--linkedin" href="#services">
            <span class="cat-index">08</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28ZM5.34 7.43a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13Zm1.78 13.02H3.56V9h3.56v11.45ZM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0Z"/></svg>
            </span>
            <span class="cat-name">LinkedIn marketing</span>
            <span class="cat-desc">B2B reach &amp; lead gen</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>

          <a class="cat-card cat-card--android" href="#services">
            <span class="cat-index">09</span>
            <span class="cat-icon">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.2 9.6h11.6v8.3c0 .6-.5 1.1-1.1 1.1h-1.1v2.2a1.3 1.3 0 1 1-2.6 0V19h-2.6v2.2a1.3 1.3 0 1 1-2.6 0V19H7.3c-.6 0-1.1-.5-1.1-1.1V9.6Zm-2.5 0a1.3 1.3 0 0 1 1.3 1.3v5.4a1.3 1.3 0 0 1-2.6 0v-5.4a1.3 1.3 0 0 1 1.3-1.3Zm17.1 0a1.3 1.3 0 0 1 1.3 1.3v5.4a1.3 1.3 0 0 1-2.6 0v-5.4a1.3 1.3 0 0 1 1.3-1.3ZM6.2 8.5c.2-1.5 1-2.8 2.2-3.6L7.2 2.7a.5.5 0 0 1 .9-.5l1.3 2.4a6.9 6.9 0 0 1 5.2 0l1.3-2.4a.5.5 0 0 1 .9.5l-1.2 2.2c1.2.8 2 2.1 2.2 3.6H6.2Zm3.3-2.1a.8.8 0 1 0 0-1.7.8.8 0 0 0 0 1.7Zm5 0a.8.8 0 1 0 0-1.7.8.8 0 0 0 0 1.7Z"/></svg>
            </span>
            <span class="cat-name">Android marketing</span>
            <span class="cat-desc">App install campaigns</span>
            <span class="cat-arrow"><svg viewBox="0 0 16 16"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ GET FOUND ============ -->
    <section class="split" id="growth">
      <div class="container split-inner">
        <div class="split-media" data-reveal>
          <div class="media-frame media-frame--peach">
            <img src="/assets/img/marketing-collage.svg" width="620" height="520" alt="Marketing dashboard and campaign creatives showing traffic growth" loading="lazy" />
            <span class="sticker sticker--peach">
              <span class="sticker-kicker">This month</span>
              <strong>12.4k clicks</strong>
            </span>
          </div>
        </div>

        <div class="split-copy" data-reveal>
          <span class="eyebrow-pill">Get found</span>
          <h2>Get found and boost sales with marketing</h2>
          <p>Take your brand to new heights by employing marketing to reach more customers and increase the number of qualified leads for your business.</p>
          <ul class="check-list">
            <li><strong>Show up in search</strong> with our SEO Tool and improve your ranking in organic results.</li>
            <li><strong>Get on the map</strong> with the right information for customers via Google My Business.</li>
            <li><strong>Advertise everywhere</strong> with Google Ads, Google Shopping ads, and Facebook Ads.</li>
          </ul>
          <a class="btn btn-outline" href="#services">Explore marketing services</a>
        </div>
      </div>
    </section>

    <!-- ============ ADVERTISING CARDS ============ -->
    <section class="services" id="services" aria-labelledby="services-title">
      <div class="container">
        <div class="services-panel">
          <div class="section-head">
            <span class="eyebrow-pill">Advertising</span>
            <h2 id="services-title">Advertising that works <span class="squiggle">as hard as you do</span></h2>
            <p>Pick a channel and we build, launch, and manage the campaigns for you.</p>
          </div>

          <div class="cards">
            <article class="service-card" data-reveal>
              <div class="service-top service-top--google">
                <span class="service-icon">
                  <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5Z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65Z"/>
                    <path fill="#FBBC05" d="M10.53 28.59A14.4 14.4 0 0 1 9.77 24c0-1.6.27-3.14.76-4.59l-7.98-6.19A23.94 23.94 0 0 0 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19Z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48Z"/>
                  </svg>
                </span>
                <span class="service-tag">Search &amp; Display</span>
              </div>
              <h3>Google Advertising</h3>
              <ul>
                <li>Business on Google</li>
                <li>Promote your Business on Google</li>
                <li>Get website ads on Google search &amp; Display</li>
              </ul>
              <a class="card-link" href="{{ route('page.show', 'google-search-ads') }}">Learn more <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            </article>

            <article class="service-card" data-reveal>
              <div class="service-top service-top--facebook">
                <span class="service-icon">
                  <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M24 12.07C24 5.44 18.63.07 12 .07S0 5.44 0 12.07c0 5.99 4.39 10.95 10.13 11.85v-8.38H7.08v-3.47h3.05V9.43c0-3.01 1.79-4.67 4.53-4.67 1.31 0 2.69.24 2.69.24v2.95h-1.51c-1.49 0-1.96.93-1.96 1.88v2.25h3.33l-.53 3.47h-2.8v8.38C19.61 23.02 24 18.06 24 12.07Z"/></svg>
                </span>
                <span class="service-tag">Social ads</span>
              </div>
              <h3>Facebook Advertising</h3>
              <ul>
                <li>Business on Facebook</li>
                <li>Promote your Page</li>
                <li>Promote your Post</li>
              </ul>
              <a class="card-link" href="{{ route('page.show', 'facebook-ads') }}">Learn more <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            </article>

            <article class="service-card" data-reveal>
              <div class="service-top service-top--instagram">
                <span class="service-icon">
                  <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2.4" y="2.4" width="19.2" height="19.2" rx="5.6" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4.4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.4" cy="6.6" r="1.3" fill="currentColor"/></svg>
                </span>
                <span class="service-tag">Social ads</span>
              </div>
              <h3>Instagram Advertising</h3>
              <ul>
                <li>Business on Instagram</li>
                <li>Promote your Profile</li>
                <li>Promote your Post</li>
              </ul>
              <a class="card-link" href="{{ route('page.show', 'instagram-ads') }}">Learn more <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            </article>

            <article class="service-card" data-reveal>
              <div class="service-top service-top--both">
                <span class="service-icon">
                  <svg class="both-fb" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M24 12.07C24 5.44 18.63.07 12 .07S0 5.44 0 12.07c0 5.99 4.39 10.95 10.13 11.85v-8.38H7.08v-3.47h3.05V9.43c0-3.01 1.79-4.67 4.53-4.67 1.31 0 2.69.24 2.69.24v2.95h-1.51c-1.49 0-1.96.93-1.96 1.88v2.25h3.33l-.53 3.47h-2.8v8.38C19.61 23.02 24 18.06 24 12.07Z"/></svg>
                  <svg class="both-ig" viewBox="0 0 24 24" aria-hidden="true"><rect x="2.4" y="2.4" width="19.2" height="19.2" rx="5.6" fill="#fff" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4.4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.4" cy="6.6" r="1.3" fill="currentColor"/></svg>
                </span>
                <span class="service-tag">Social ads</span>
              </div>
              <h3>Facebook Instagram</h3>
              <ul>
                <li>Revenue on Business</li>
                <li>Promote your Profile</li>
                <li>Promote your Post</li>
              </ul>
              <a class="card-link" href="{{ route('page.show', 'facebook-ads') }}">Learn more <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ SEO ============ -->
    <section class="seo-section" id="seo">
      <div class="container">
        <div class="seo-panel">
          <div class="seo-media" data-reveal>
            <div class="media-frame media-frame--white">
              <img src="/assets/img/seo-laptop.svg" width="620" height="500" alt="Bakery website on a laptop with search ranking and traffic analytics cards" loading="lazy" />
            </div>
            <span class="sticker sticker--lime">
              <span class="sticker-kicker">Ranking</span>
              <strong>#1 on Google</strong>
            </span>
          </div>
          <div class="seo-copy" data-reveal>
            <span class="eyebrow-pill eyebrow-pill--dark">SEO Tool</span>
            <h2>Improve your website's search engine ranking</h2>
            <p>Increase the quantity and quality of organic traffic to your website. Our tools help you optimize your site for search engines, so the right customers find you first.</p>
            <p>We handle the technical audits, keyword research, and on-page work for you — then track your rankings month after month.</p>
            <div class="seo-stats">
              <div><strong>+128%</strong><span>organic traffic</span></div>
              <div><strong>2.4k</strong><span>keywords tracked</span></div>
              <div><strong>30</strong><span>days to results</span></div>
            </div>
            <a class="btn btn-lime btn-lg" href="#get-started">Get Started</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="faq" id="faq" aria-labelledby="faq-title">
      <div class="container faq-grid">
        <div class="faq-intro">
          <span class="eyebrow-pill">Good to know</span>
          <h2 id="faq-title">Frequently Asked Questions</h2>
          <p>Everything you need to know before we start building.</p>
          <div class="help-card">
            <div class="help-avatars" aria-hidden="true"><span>SC</span><span>TH</span><span>SM</span></div>
            <div>
              <strong>Still curious?</strong>
              <a class="link-arrow link-arrow--dark" href="#get-started">Talk to a human</a>
            </div>
          </div>
        </div>

        <div class="faq-list">
          <details class="faq-item" open>
            <summary>How long does it take to build my website?<span class="faq-plus" aria-hidden="true"></span></summary>
            <div class="faq-answer"><p>Most websites go live within 7 to 14 days. After a short kickoff call we produce your first design draft in 48 hours, then refine it together until it reflects your brand perfectly.</p></div>
          </details>
          <details class="faq-item">
            <summary>What do I need to provide to get started?<span class="faq-plus" aria-hidden="true"></span></summary>
            <div class="faq-answer"><p>Just your logo, any brand assets you already have, and a few photos. Our copywriters can draft the text for you if you don't have it yet.</p></div>
          </details>
          <details class="faq-item">
            <summary>Do you manage Google and social ads too?<span class="faq-plus" aria-hidden="true"></span></summary>
            <div class="faq-answer"><p>Yes. We set up, launch, and optimize Google Search, Google Shopping, Facebook, and Instagram campaigns. You get one dashboard and a plain-language report each month.</p></div>
          </details>
          <details class="faq-item">
            <summary>Is there a long-term contract?<span class="faq-plus" aria-hidden="true"></span></summary>
            <div class="faq-answer"><p>No. Our plans are month to month, and you can cancel or pause at any time. The website you paid for is yours to keep.</p></div>
          </details>
          <details class="faq-item">
            <summary>Can you improve my existing website instead?<span class="faq-plus" aria-hidden="true"></span></summary>
            <div class="faq-answer"><p>Absolutely. Many clients start with a speed, SEO, and conversion audit of their current site. We fix what's holding it back before rebuilding anything.</p></div>
          </details>
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
            <h2>Start building your business online</h2>
            <p>Focus your energy on running your business while we take care of the website and the advertising. Hassle-free, time-saving, opt out any time.</p>
          </div>
          <div class="cta-actions">
            <a class="btn btn-light btn-lg" href="#top">Get started</a>
            <a class="btn btn-glass btn-lg" href="#categories">Talk to an expert</a>
          </div>
        </div>
      </div>
    </section>
@endsection
