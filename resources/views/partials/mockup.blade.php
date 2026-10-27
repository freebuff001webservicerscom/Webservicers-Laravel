{{--
  UI mockup visuals used in service page heroes and showcases.
  $name matches the reference site's MOCKUPS keys.
--}}
@switch($name)
    {{-- Google search results page on a desktop monitor --}}
    @case('ads_serp')
        <div class="monitor">
            <div class="monitor-screen">
                <div class="serp">
                    <div class="serp-top">
                        <span class="serp-logo">G</span>
                        <div class="serp-field">emergency plumber near me</div>
                    </div>
                    <div class="serp-tabs"><span class="is-active">All</span><span>Maps</span><span>Shopping</span><span>Images</span></div>
                    <div class="ad">
                        <div class="ad-head"><span class="ad-tag">Sponsored</span><span class="ad-brand">Your Business</span></div>
                        <p class="ad-title">24/7 Emergency Plumber · 60-Minute Response</p>
                        <p class="ad-url">yourbusiness.com › emergency</p>
                        <p class="ad-copy">Licensed local plumbers, fixed quotes and no call-out fee. Book online in 60 seconds.</p>
                        <div class="ad-ext"><span>Call now</span><span>Directions</span><span>Get a quote</span></div>
                    </div>
                    <div class="ad ad--muted">
                        <div class="ad-head"><span class="ad-tag">Sponsored</span><span class="ad-brand">City Plumbing Co.</span></div>
                        <p class="ad-title">Local Plumbers You Can Trust</p>
                        <p class="ad-url">cityplumbing.example › services</p>
                        <p class="ad-copy">Same-day repairs across the city. Rated 4.8 by 300 neighbours.</p>
                    </div>
                </div>
            </div>
            <div class="monitor-stand"></div>
            <div class="monitor-base"></div>
        </div>
        @break

    {{-- Search ranking result in a browser window --}}
    @case('rank_browser')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">google.com/search?q=artisan+donuts</span>
            </div>
            <div class="browser-body">
                <div class="serp">
                    <div class="serp-top">
                        <span class="serp-logo">G</span>
                        <div class="serp-field">artisan donuts near me</div>
                    </div>
                    <div class="serp-tabs"><span class="is-active">All</span><span>Maps</span><span>Images</span></div>
                    <div class="serp-highlight">
                        <div class="ad-head"><span class="ad-rank">1</span><span class="ad-brand">Flour &amp; Co.</span></div>
                        <p class="ad-title">Artisan Donuts Baked Fresh Every Morning</p>
                        <p class="ad-url">flourandco.example › menu</p>
                        <div class="ad-ext"><span>Menu</span><span>Order online</span><span>Directions</span></div>
                    </div>
                    <div class="ad"><p class="ad-title">Donut Delivery In 30 Minutes</p><p class="ad-url">donutdelivery.example</p></div>
                    <div class="ad"><p class="ad-title">Best Rated Donuts In Town</p><p class="ad-url">citybakes.example</p></div>
                </div>
            </div>
        </div>
        @break

    {{-- Shopping results in a phone --}}
    @case('shop_phone')
        <div class="phone">
            <div class="phone-screen">
                <div class="phone-head"><strong>Shopping</strong><span class="phone-pill">Free listings</span></div>
                <div class="phone-search">ceramic planters</div>
                <div class="shop-grid">
                    <div class="prod"><span class="prod-img"></span><span class="prod-name">Ribbed planter</span><span class="prod-price">£24.00</span></div>
                    <div class="prod"><span class="prod-img prod-img--2"></span><span class="prod-name">Terra pot</span><span class="prod-price">£18.00</span></div>
                    <div class="prod"><span class="prod-img prod-img--3"></span><span class="prod-name">Glazed bowl</span><span class="prod-price">£32.00</span></div>
                    <div class="prod"><span class="prod-img prod-img--4"></span><span class="prod-name">Clay set</span><span class="prod-price">£41.00</span></div>
                </div>
            </div>
        </div>
        @break

    {{-- Facebook feed ad in a phone --}}
    @case('fb_phone')
        <div class="phone">
            <div class="phone-screen">
                <div class="feed">
                    <div class="feed-head">
                        <span class="avatar">YB</span>
                        <div><strong>Your Business</strong><span>Sponsored · Suggested for you</span></div>
                    </div>
                    <p class="feed-text">Spring is here. Refresh your space with 20% off handmade planters — this week only.</p>
                    <div class="feed-img"></div>
                    <div class="feed-cta"><strong>yourbusiness.example</strong><span>SHOP NOW</span></div>
                    <div class="feed-social"><span>👍 ❤️ 1.2k</span><span>84 comments · 210 shares</span></div>
                </div>
            </div>
        </div>
        @break

    {{-- Instagram post in a phone --}}
    @case('ig_phone')
        <div class="phone">
            <div class="phone-screen">
                <div class="ig-head"><span class="avatar avatar--grad">YB</span><strong>yourbusiness</strong></div>
                <div class="ig-img"><span class="ig-badge">Reel</span></div>
                <div class="ig-actions"><span>♥</span><span>◯</span><span>➤</span></div>
                <p class="ig-caption"><strong>yourbusiness</strong> New drop. Six colours, made in small batches. Tap to shop ✨</p>
            </div>
        </div>
        @break

    {{-- Google Business Profile in a browser --}}
    @case('map_browser')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">google.com/maps › flour-and-co</span>
            </div>
            <div class="browser-body">
                <div class="map">
                    <span class="map-pin"></span>
                    <div class="map-card">
                        <div class="map-stars">★★★★★ <span>4.9 · 212 reviews</span></div>
                        <h4>Flour &amp; Co. Bakery</h4>
                        <div class="map-meta"><span>Bakery · Open until 18:00</span><span>12 Market Street</span></div>
                        <div class="map-actions"><span>Call</span><span>Directions</span><span>Website</span></div>
                    </div>
                </div>
            </div>
        </div>
        @break

    {{-- Analytics dashboard in a browser --}}
    @case('dash_browser')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">analytics.yourbusiness.example</span>
            </div>
            <div class="browser-body">
                <div class="dash">
                    <div class="dash-head">
                        <span class="dash-title">Growth overview</span>
                        <span class="dash-live"><i></i> Live</span>
                    </div>
                    <div class="kpis">
                        <div class="kpi"><span>Visitors</span><strong>24.8k <em>+38%</em></strong></div>
                        <div class="kpi"><span>Leads</span><strong>412 <em>+19%</em></strong></div>
                        <div class="kpi"><span>Revenue</span><strong>£84k <em>+42%</em></strong></div>
                    </div>
                    <svg class="dash-chart" viewBox="0 0 460 130" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="dashFill" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#12a150" stop-opacity=".22"/>
                                <stop offset="1" stop-color="#12a150" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <g stroke="#f0eef6" stroke-width="1">
                            <line x1="0" y1="34" x2="460" y2="34"/><line x1="0" y1="70" x2="460" y2="70"/><line x1="0" y1="106" x2="460" y2="106"/>
                        </g>
                        <path d="M0 108 L58 92 L116 100 L174 70 L232 78 L290 50 L348 58 L406 30 L460 16 L460 130 L0 130 Z" fill="url(#dashFill)"/>
                        <path d="M0 108 L58 92 L116 100 L174 70 L232 78 L290 50 L348 58 L406 30 L460 16" fill="none" stroke="#12a150" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <div class="dash-legend"><span><i></i> Organic</span><span><i style="background:#ff8a5b"></i> Paid</span><span><i style="background:#f5b301"></i> Direct</span></div>
                </div>
            </div>
        </div>
        @break

    {{-- Mini website in a browser --}}
    @case('site_browser')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">flourandco.example</span>
            </div>
            <div class="browser-body">
                <div class="mini-site">
                    <div class="mini-site-head">
                        <span class="mini-site-logo">FLOUR &amp; CO.</span>
                        <div class="mini-site-nav"><span></span><span></span><span></span></div>
                    </div>
                    <div class="mini-site-hero">
                        <div>
                            <h3>Any flavor<br />you desire</h3>
                            <p>Small-batch donuts, baked every morning.</p>
                            <span class="mini-site-btn">Order now</span>
                        </div>
                        <div class="mini-donuts">
                            <span class="mini-donut mini-donut--1"></span>
                            <span class="mini-donut mini-donut--2"></span>
                            <span class="mini-donut mini-donut--3"></span>
                        </div>
                    </div>
                    <div class="mini-strip">
                        <div class="mini-tile"><i></i><span></span></div>
                        <div class="mini-tile"><i></i><span></span></div>
                        <div class="mini-tile"><i></i><span></span></div>
                    </div>
                </div>
            </div>
        </div>
        @break

    {{-- Design board in a browser --}}
    @case('design_browser')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">figma.com › flour-and-co</span>
            </div>
            <div class="browser-body">
                <div class="design-board">
                    <div>
                        <div class="wire">
                            <div class="wire-line wire-line--dark"></div>
                            <div class="wire-line"></div>
                            <div class="wire-box"></div>
                            <div class="wire-line" style="width:76%"></div>
                            <div class="wire-line wire-line--accent"></div>
                        </div>
                        <div class="wire" style="margin-top:8px">
                            <div class="wire-line" style="width:52%"></div>
                            <div class="wire-line" style="width:84%"></div>
                            <div class="wire-line" style="width:64%"></div>
                        </div>
                    </div>
                    <div class="wire">
                        <div class="type-sample">Aa</div>
                        <div class="type-label">Poppins · Display</div>
                        <div class="swatches"><i></i><i></i><i></i><i></i></div>
                        <div class="wire-line" style="margin-top:12px"></div>
                        <div class="wire-line" style="width:70%"></div>
                    </div>
                </div>
            </div>
        </div>
        @break

    {{-- Brand board in a browser --}}
    @case('brand_browser')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">brand.flourandco.example</span>
            </div>
            <div class="browser-body">
                <div class="design-board design-board--brand">
                    <div class="wire">
                        <div class="type-label">Wordmark</div>
                        <div class="brand-sample">Flour &amp; Co.</div>
                        <div class="swatches"><i></i><i></i><i></i><i></i></div>
                    </div>
                    <div class="wire">
                        <div class="type-label">Type scale</div>
                        <div class="type-heading">Heading</div>
                        <div class="type-body">Body copy sample for the brand.</div>
                        <div class="wire-line" style="margin-top:10px"></div>
                        <div class="wire-line" style="width:64%"></div>
                    </div>
                    <div class="wire wire--row">
                        <div class="wire-box" style="background:#fff1e8"></div>
                        <div class="wire-box" style="background:#eef1ff"></div>
                        <div class="wire-box" style="background:#f6f3ec"></div>
                    </div>
                </div>
            </div>
        </div>
        @break

    {{-- Product feed table in a browser --}}
    @case('feed_table')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">merchant.google.com › products</span>
            </div>
            <div class="browser-body">
                <div class="ft">
                    <div class="ft-head"><span>Product feed</span><span class="mk-pill">98% approved</span></div>
                    <div class="ft-row"><span class="ft-thumb" style="--c:#e8d7c4"></span><span class="ft-name">Ribbed planter</span><span class="ft-price">£24.00</span><span class="ft-status">Approved</span></div>
                    <div class="ft-row"><span class="ft-thumb" style="--c:#d9e5d6"></span><span class="ft-name">Terra pot</span><span class="ft-price">£18.00</span><span class="ft-status">Approved</span></div>
                    <div class="ft-row"><span class="ft-thumb" style="--c:#e9def5"></span><span class="ft-name">Glazed bowl</span><span class="ft-price">£32.00</span><span class="ft-status">Approved</span></div>
                    <div class="ft-row"><span class="ft-thumb" style="--c:#f6e7d2"></span><span class="ft-name">Clay set</span><span class="ft-price">£41.00</span><span class="ft-status ft-status--warn">Needs image</span></div>
                </div>
            </div>
        </div>
        @break

    {{-- Instagram grid in a browser --}}
    @case('ig_grid')
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">instagram.com › yourbusiness</span>
            </div>
            <div class="browser-body">
                <div class="ig-grid">
                    <span class="ig-tile ig-tile--1"></span>
                    <span class="ig-tile ig-tile--2"></span>
                    <span class="ig-tile ig-tile--3"></span>
                    <span class="ig-tile ig-tile--4"></span>
                    <span class="ig-tile ig-tile--5"></span>
                    <span class="ig-tile ig-tile--6"></span>
                </div>
            </div>
        </div>
        @break

    {{-- Reviews in a phone --}}
    @case('reviews_phone')
        <div class="phone">
            <div class="phone-screen">
                <div class="rev-head"><strong>Reviews</strong><span class="phone-pill">4.9 ★</span></div>
                <div class="rev-score"><strong>212</strong><span>reviews this year</span></div>
                <div class="rev-card">
                    <div class="rev-stars">★★★★★</div>
                    <p>“Fast, tidy and honest about the price. Booked again for next month.”</p>
                    <span>Sarah C. · 2 days ago</span>
                </div>
                <div class="rev-card">
                    <div class="rev-stars">★★★★★</div>
                    <p>“Turned up on a Sunday and fixed it in an hour. Lifesavers.”</p>
                    <span>Tom H. · 1 week ago</span>
                </div>
                <div class="rev-actions"><span>Request a review</span></div>
            </div>
        </div>
        @break

    {{-- Weekly digest in a phone --}}
    @case('digest_phone')
        <div class="phone">
            <div class="phone-screen">
                <div class="phone-head"><strong>Weekly digest</strong><span class="phone-pill">Mon 08:00</span></div>
                <p class="dg-title">Your week in three numbers</p>
                <div class="dg-kpis">
                    <div><strong>£3.2k</strong><span>spend</span></div>
                    <div><strong>86</strong><span>leads</span></div>
                    <div><strong>4.1x</strong><span>ROAS</span></div>
                </div>
                <div class="dg-note"><strong>Best performer</strong><span>Google Search · £12.40 per lead</span></div>
                <div class="dg-note"><strong>Watch out</strong><span>Meta frequency at 4.1 — refresh creative</span></div>
                <div class="mk-dotline"><i></i> One action for this week: shift £400 to Search.</div>
            </div>
        </div>
        @break

    {{-- Mobile website in a phone --}}
    @case('site_phone')
        <div class="phone">
            <div class="phone-screen">
                <div class="mini-site mini-site--phone">
                    <div class="mini-site-head">
                        <span class="mini-site-logo">FLOUR &amp; CO.</span>
                        <span class="mini-menu">≡</span>
                    </div>
                    <div class="mini-donuts mini-donuts--phone">
                        <span class="mini-donut mini-donut--1"></span>
                        <span class="mini-donut mini-donut--2"></span>
                    </div>
                    <h3 class="mini-phone-title">Any flavor<br />you desire</h3>
                    <p class="mini-phone-copy">Small-batch donuts, baked every morning.</p>
                    <span class="mini-site-btn">Order now</span>
                    <div class="mini-strip mini-strip--2">
                        <div class="mini-tile"><i></i><span></span></div>
                        <div class="mini-tile"><i></i><span></span></div>
                    </div>
                </div>
            </div>
        </div>
        @break

    @default
        <div class="browser">
            <div class="browser-bar">
                <span class="browser-dots"><i></i><i></i><i></i></span>
                <span class="browser-url">yourbusiness.com</span>
            </div>
            <div class="browser-body"></div>
        </div>
@endswitch
