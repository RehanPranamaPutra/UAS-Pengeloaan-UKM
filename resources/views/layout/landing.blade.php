<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title','Info UKM')</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    /* Smooth scroll */
    html { scroll-behavior: smooth; }

    body {
      padding-top: 70px;
      font-family: 'Segoe UI', sans-serif;
      background: #f5f9ff;
    }

    /* Navbar */
    .navbar { background: #0077b6; }
    .navbar-brand, .nav-link { color: #fff !important; }
    .nav-link:hover { color: #ffd60a !important; }

    /* Footer */
    footer {
      background: #023e8a;
      color: #fff;
      padding: .75rem 0;
      text-align: center;
      position: relative;
      bottom: 0;
      width: 100%;
    }
  </style>

  @stack('styles')
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ route('landing.index') }}">Info UKM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#ukm">UKM</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>@yield('content')</main>

  <footer>
    &copy; {{ date('Y') }} &mdash; Portal UKM
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
