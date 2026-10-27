@php
    /*
    | Sidebar is compiled from config/admin.php. Each entry resolves to an
    | href + whether it is active for the current request, so submenu groups
    | open automatically on the page you are on.
    */
    $nav = collect(config('admin.menu'))->map(function (array $group): array {
        $group['items'] = collect($group['items'])->map(function (array $item): array {
            $item['children'] = collect($item['children'] ?? [])->map(fn (array $child): array => $child + [
                'href' => isset($child['route']) ? route($child['route']) : route('admin.records.index', $child['resource']),
                'resource' => $child['resource'] ?? null,
            ])->all();

            $item['href'] = isset($item['route'])
                ? route($item['route'])
                : (isset($item['resource']) ? route('admin.records.index', $item['resource']) : null);

            $active = $item['href'] !== null && url($item['href']) === url()->current();
            $item['active'] = $active || collect($item['children'])->contains(fn (array $child): bool => url($child['href']) === url()->current());
            $item['open'] = $item['active'];

            return $item;
        })->all();

        return $group;
    })->values();

    // Breadcrumb: "Workspace › <group> › <page>"
    $crumbs = ['Workspace'];
    foreach ($nav as $group) {
        foreach ($group['items'] as $item) {
            $matched = collect($item['children'])->first(fn (array $child): bool => url($child['href']) === url()->current());
            if ($matched) {
                $crumbs[] = $group['label'];
                $crumbs[] = $matched['label'];
                break 2;
            }
            if ($item['href'] !== null && url($item['href']) === url()->current()) {
                $crumbs[] = $group['label'];
                $crumbs[] = $item['label'];
                break 2;
            }
        }
    }

    $unreadNotices = \App\Models\Notice::query()->unread()->count();
@endphp

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('pageTitle', 'Workspace') — {{ $siteName }}</title>
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
        <a class="side-brand" href="{{ route('admin.overview') }}">
          <span class="side-brand-mark" aria-hidden="true">
            <svg viewBox="0 0 40 40" fill="none">
              <rect width="40" height="40" rx="12" fill="url(#wsMarkA)"/>
              <path d="M9.5 13.2 14.9 26.8 20 17.6 25.1 26.8 30.5 13.2" stroke="#fff" stroke-width="3.1" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="34.6" cy="7.6" r="2.2" fill="#E4FF6A"/>
              <defs>
                <linearGradient id="wsMarkA" x1="4" y1="2" x2="36" y2="40" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#0C7C5A"/>
                  <stop offset="1" stop-color="#043B2A"/>
                </linearGradient>
              </defs>
            </svg>
          </span>
          <span class="side-brand-text">
            <strong>{{ $siteName }}</strong>
            <small>Commerce OS</small>
          </span>
        </a>
        <button class="icon-btn side-collapse" type="button" id="sidebarCollapse" aria-label="Collapse sidebar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M9 4v16"/></svg>
        </button>
      </div>

      <button class="workspace-pill" type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="3"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
        <span>{{ $siteName }} HQ</span>
        <svg class="ws-chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="m8 9 4-4 4 4M8 15l4 4 4-4"/></svg>
      </button>

      <nav class="side-nav" aria-label="Workspace navigation">
        @foreach ($nav as $group)
          <div class="nav-group">
            <p class="nav-group-label">{{ $group['label'] }}</p>
            @foreach ($group['items'] as $item)
              @if (!empty($item['children']))
                <div class="nav-item has-children{{ $item['open'] ? ' is-open' : '' }}">
                  <button class="nav-link" type="button" data-submenu>
                    <span class="nav-icon">@include('partials.admin.icon', ['name' => $item['icon'] ?? 'dot'])</span>
                    <span class="nav-label">{{ $item['label'] }}</span>
                    <svg class="nav-chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                  </button>
                  <div class="nav-children">
                    @foreach ($item['children'] as $child)
                      <a class="nav-child{{ url($child['href']) === url()->current() ? ' is-active' : '' }}" href="{{ $child['href'] }}">{{ $child['label'] }}</a>
                    @endforeach
                  </div>
                </div>
              @else
                <div class="nav-item">
                  <a class="nav-link{{ $item['active'] ? ' is-active' : '' }}" href="{{ $item['href'] }}">
                    <span class="nav-icon">@include('partials.admin.icon', ['name' => $item['icon'] ?? 'dot'])</span>
                    <span class="nav-label">{{ $item['label'] }}</span>
                  </a>
                </div>
              @endif
            @endforeach
          </div>
        @endforeach
      </nav>

      <div class="side-foot">
        <a class="icon-btn" href="{{ route('admin.team.index') }}" title="Team members">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.2"/><path d="M3.5 19c.6-3 2.8-4.6 5.5-4.6s4.9 1.6 5.5 4.6M16 5.5a3 3 0 0 1 0 5.8M17.5 14.4c2 .5 3.3 1.9 3.7 4.4"/></svg>
        </a>
        <a class="icon-btn has-badge" href="{{ route('admin.notifications.index') }}" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5h-15S6 13 6 9Z"/><path d="M10 18.5a2 2 0 0 0 4 0"/></svg>
          @if ($unreadNotices > 0)<span class="badge-dot">{{ $unreadNotices }}</span>@endif
        </a>
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
          <form class="topsearch" method="get" action="{{ route('admin.search') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4 4"/></svg>
            <input type="search" name="q" placeholder="Search pages, orders, customers…" value="{{ request('q') }}" />
            <kbd>⌘K</kbd>
          </form>

          <button class="btn btn-dark" type="button" data-open-modal="newOrderModal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            New order
          </button>
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

  <!-- Global: create order modal (topbar "+ New order") -->
  <div class="modal-backdrop" id="newOrderModal" hidden>
    <div class="modal" role="dialog" aria-modal="true" aria-label="New order">
      <div class="modal-head">
        <h3>New order</h3>
        <button class="icon-btn" type="button" data-close-modal aria-label="Close">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
        </button>
      </div>
      <form method="post" action="{{ route('admin.orders.store') }}">
        @csrf
        <div class="form-grid">
          <label class="field"><span>Customer name *</span>
            <input name="customer_name" type="text" required placeholder="Alex Morgan" />
          </label>
          <label class="field"><span>Customer email *</span>
            <input name="customer_email" type="email" required placeholder="you@business.com" />
          </label>
          <label class="field"><span>Service</span>
            <input name="service" type="text" placeholder="Google Search Ads" />
          </label>
          <label class="field"><span>Amount ($) *</span>
            <input name="amount" type="number" min="0" step="0.01" required placeholder="149" />
          </label>
          <label class="field"><span>Status</span>
            <select name="status">
              <option value="pending">Pending</option>
              <option value="paid">Paid</option>
              <option value="in_progress">In progress</option>
              <option value="completed">Completed</option>
            </select>
          </label>
        </div>
        <div class="modal-actions">
          <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
          <button class="btn btn-dark" type="submit">Create order</button>
        </div>
      </form>
    </div>
  </div>

  <script src="/assets/admin/admin.js" defer></script>
</body>
</html>
