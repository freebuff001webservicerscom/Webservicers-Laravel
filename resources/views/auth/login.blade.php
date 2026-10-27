<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign in — WebServicers</title>
  <meta name="robots" content="noindex" />
  <meta name="theme-color" content="#081512" />
  <link rel="icon" href="/assets/img/favicon.svg" type="image/svg+xml" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/admin/admin.css" />
</head>
<body class="auth-screen">
  <main class="auth-card">
    <a class="auth-brand" href="/" aria-label="WebServicers — home">
      <span class="brand-mark" aria-hidden="true">
        <svg viewBox="0 0 40 40" fill="none">
          <rect width="40" height="40" rx="12" fill="url(#wsMarkL)"/>
          <path d="M9.5 13.2 14.9 26.8 20 17.6 25.1 26.8 30.5 13.2" stroke="#fff" stroke-width="3.1" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="34.6" cy="7.6" r="2.2" fill="#E4FF6A"/>
          <defs>
            <linearGradient id="wsMarkL" x1="4" y1="2" x2="36" y2="40" gradientUnits="userSpaceOnUse">
              <stop stop-color="#0C7C5A"/>
              <stop offset="1" stop-color="#043B2A"/>
            </linearGradient>
          </defs>
        </svg>
      </span>
      <span class="brand-text"><span class="brand-word">Web</span><span class="brand-word--accent">Servicers</span></span>
    </a>

    <div class="auth-copy">
      <h1>Sign in</h1>
      <p>Enter your workspace to manage pages, orders and settings.</p>
    </div>

    @if ($errors->any())
      <div class="auth-alert" role="alert">{{ $errors->first() }}</div>
    @endif

    <form class="auth-form" method="post" action="{{ route('login') }}">
      @csrf
      <div class="field">
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" placeholder="you@business.com" required autofocus />
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" placeholder="••••••••" required />
      </div>

      <label class="auth-remember">
        <input type="checkbox" name="remember" value="1" />
        <span>Keep me signed in</span>
      </label>

      <button class="btn btn-dark btn-lg auth-submit" type="submit">Sign in</button>
    </form>

    <p class="auth-foot">Not a customer yet? <a href="/contact">Talk to an expert</a></p>
  </main>
</body>
</html>
