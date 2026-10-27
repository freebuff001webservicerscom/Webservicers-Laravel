@php
    /*
    | Customer-facing shell. Same markup, classes and assets as the admin
    | workspace so both panels share one visual language — only the nav
    | items differ (no admin-only menus, search or order shortcuts).
    */
    $items = [
        ['label' => 'Orders', 'route' => 'dashboard.orders.index', 'icon' => 'receipt'],
        ['label' => 'Support tickets', 'route' => 'dashboard.tickets.index', 'icon' => 'inbox'],
        ['label' => 'Balance', 'route' => 'dashboard.balance', 'icon' => 'wallet'],
        ['label' => 'Billing & invoices', 'route' => 'dashboard.billing.index', 'icon' => 'card'],
        ['label' => 'Profile settings', 'route' => 'dashboard.profile', 'icon' => 'users'],
    ];

    $currentRoute = (string) request()->route()?->getName();

    foreach ($items as $index => $item) {
        $items[$index]['active'] = $currentRoute === $item['route']
            || str_starts_with($currentRoute, $item['route'].'.');
    }

    $crumbs = ['Account', @yield('crumb', 'Account')];
@endphp

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('pageTitle', 'Dashboard') — {{ $siteName }}</title>
  <meta name="robots" content="noindex" />
  <meta name="theme-color" content="#111114" />
  <link rel="icon" href="/assets/img/favicon.svg" type="image/svg+xml" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/admin/admin.css" />
  <script>
    try {
      var saved = localStorage.getItem('ws-theme');
      if (saved) document.documentElement.setAttribute('data-theme', saved);
    } catch (e) {}
  </script>
</head>
<body class="admin-body">
  <div class="admin-shell">
    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-head">
        <a class="side-brand" href="{{ route('dashboard.home') }}">
          <span class="side-brand-mark" aria-hidden="true">
            <svg viewBox="0 0 40 40" fill="none">
              <rect width="40" height="40" rx="12" fill="url(#wsMarkU)"/>
              <path d="M9.5 13.2 14.9 26.8 20 17.6 25.1 26.8 30.5 13.2" stroke="#fff" stroke-width="3.1" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="34.6" cy="7.6" r="2.2" fill="#E4FF6A"/>
              <defs>
                <linearGradient id="wsMarkU" x1="4" y1="2" x2="36" y2="40" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#0C7C5A"/>
                  <stop offset="1" stop-color="#043B2A"/>
                </linearGradient>
              </defs>
            </svg>
          </span>
          <span class="side-brand-text">
            <strong>{{ $siteName }}</strong>
            <small>My account</small>
          </span>
        </a>
        <button class="icon-btn side-collapse" type="button" id="sidebarCollapse" aria-label="Collapse sidebar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M9 4v16"/></svg>
        </button>
      </div>

      <a class="workspace-pill" href="{{ route('dashboard.profile') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8.5" r="3.7"/><path d="M4.5 19.5c1.3-3.4 4-5.1 7.5-5.1s6.2 1.7 7.5 5.1"/></svg>
        <span>{{ auth()->user()->name }}</span>
        <svg class="ws-chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="m8 9 4-4 4 4M8 15l4 4 4-4"/></svg>
      </a>

      <nav class="side-nav" aria-label="Account navigation">
        <div class="nav-group">
          <p class="nav-group-label">Account</p>
          @foreach ($items as $item)
            <div class="nav-item">
              <a class="nav-link{{ $item['active'] ? ' is-active' : '' }}" href="{{ route($item['route']) }}">
                <span class="nav-icon">@include('partials.admin.icon', ['name' => $item['icon']])</span>
                <span class="nav-label">{{ $item['label'] }}</span>
              </a>
            </div>
          @endforeach
        </div>
      </nav>

      <div class="side-foot">
        <button class="icon-btn" type="button" id="themeToggle" title="Toggle theme">
          <svg class="ic-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg class="ic-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.5A8.5 8.5 0 0 1 9.5 4 8.5 8.5 0 1 0 20 14.5Z"/></svg>
        </button>
        <form method="post" action="{{ route('logout') }}">
          @csrf
          <button class="icon-btn" type="submit" title="Sign out">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3M16 17l5-5-5-5M21 12H9"/></svg>
          </button>
        </form>
      </div>
    </aside>

    <div class="sidebar-scrim" id="sidebarScrim"></div>

    <!-- ================= MAIN ================= -->
    <div class="admin-main">
      <header class="topbar">
        <button class="icon-btn topbar-menu" type="button" id="mobileMenu" aria-label="Open menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>

        <nav class="crumbline" aria-label="Breadcrumb">
          @foreach ($crumbs as $index => $crumb)
            @if ($index > 0)<span class="crumb-sep">›</span>@endif
            <span class="{{ $index === count($crumbs) - 1 ? 'crumb-current' : '' }}">{{ $crumb }}</span>
          @endforeach
        </nav>

        <div class="topbar-actions">
          <a class="btn btn-dark" href="{{ route('dashboard.tickets.index') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            New ticket
          </a>
        </div>
      </header>

      <main class="admin-content">
        @if (session('status'))
          <div class="flash" role="status">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 13 4 4L19 7"/></svg>
            {{ session('status') }}
          </div>
        @endif

        @yield('content')
      </main>
    </div>
  </div>

  <script src="/assets/admin/admin.js" defer></script>
  @yield('scripts')
</body>
</html>
