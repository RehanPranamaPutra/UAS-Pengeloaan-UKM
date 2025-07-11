<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF‑8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Dashboard UKM')</title>
  @stack('style')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; }
    .sidebar-scroll::-webkit-scrollbar { width: 6px; }
    .sidebar-scroll::-webkit-scrollbar-thumb { background: #A39171; border-radius: 6px; }

    .sidebar {
      width: 260px;
      background: #ABC4AB;
      color: #2F2E2E;
      transition: all .3s;
      position: relative;
    }
    .sidebar .nav-link { color: #2F2E2E; font-weight: 500; transition: all .3s; }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: #A39171; color: #fff; border-radius: 4px;
    }

    /* Floating dropdown submenu */
    .dropdown-parent { position: relative; }
    .submenu {
      display: none;
      position: absolute;
      top: 0; left: 100%;
      background: #ABC4AB;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      border-radius: 4px;
      padding: 8px 0;
      width: 200px;
      z-index: 100;
    }
    .dropdown-parent:hover > .submenu {
      display: block;
    }
    .submenu .nav-link {
      padding: 8px 16px; margin: 2px 0;
      color: #2F2E2E; border-radius: 4px;
      white-space: nowrap;
    }
    .submenu .nav-link:hover,
    .submenu .nav-link.active {
      background: #8A6A5A; color: #fff;
    }

    /* Slide-down effect when clicked */
    .submenu.collapse.show {
      display: block !important;
    }

    .rotate-90 {
      transform: rotate(90deg);
      transition: transform .3s;
    }
    .header {
      position: sticky; top: 0;
      background: #fff;
      padding: 1rem 2rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
      border-bottom: 1px solid #E0E0E0;
      z-index: 10;
    }
  </style>
</head>
<body class="bg-light vh-100">
  <div class="d-flex h-100">
    <aside class="sidebar sidebar-scroll d-flex flex-column">
      <div class="px-3 py-3 border-bottom" style="border-color:#E0E0E0;">
        <h5 class="mb-0">UKM Panel</h5>
      </div>

      <nav class="nav flex-column flex-grow-1 p-2">
    <a href="{{ route('ukm.index') }}" class="nav-link @yield('navUkm')">
      <i class="fas fa-building me-2"></i> UKM
    </a>

    @php $menus = ['anggota'=>'users','kegiatan'=>'calendar-alt','capaian'=>'trophy']; @endphp

    @foreach($menus as $key => $icon)
      <div class="dropdown-parent mb-1">
        <a href="javascript:void(0)"
           class="nav-link d-flex justify-content-between align-items-center @yield('nav'.ucfirst($key).'Parent')"
           onclick="toggleMenu('{{ $key }}')">
          <span><i class="fas fa-{{ $icon }} me-2"></i> {{ ucfirst($key) }}</span>
          <i id="arrow-{{ $key }}" class="fas fa-chevron-right @yield('nav'.ucfirst($key).'Parent') rotate-90"></i>
        </a>

        <div id="menu-{{ $key }}"
             class="submenu collapse @yield('nav'.ucfirst($key).'Parent')">
          @foreach($sidebar_ukms as $ukm)
            @can('access', $ukm->id)
              <a href="{{ route($key.'.index',['ukm_id'=>$ukm->id]) }}"
                 class="nav-link @if(request('ukm_id') == $ukm->id) active @endif">
                • {{ $ukm->nama_ukm }}
              </a>
            @endcan
          @endforeach
        </div>
      </div>
    @endforeach
</nav>


      <div class="p-3 border-top text-center" style="border-color:#E0E0E0;">
        <small>Signed in as <strong>{{ Auth::user()->name }}</strong></small><br>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" class="text-decoration-none" style="color:#A39171;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sign out
        </a>
      </div>
    </aside>

    <main class="flex-fill d-flex flex-column">
      <div class="header d-flex justify-content-between align-items-center">
        <h2 class="mb-0">@yield('title','Dashboard')</h2>
        <div class="d-flex align-items-center">
          <a href="#" class="me-3 text-secondary"><i class="fas fa-user fa-lg"></i></a>
          <a href="#" class="text-secondary"><i class="fas fa-sign-out-alt fa-lg"></i></a>
        </div>
      </div>
      <div class="p-4 overflow-auto">
        @yield('content')
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleMenu(key) {
      const menu = document.getElementById('menu-' + key);
      const arrow = document.getElementById('arrow-' + key);
      const show = menu.classList.toggle('show');
      arrow.classList.toggle('rotate-90', show);
    }
  </script>
</body>
</html>
