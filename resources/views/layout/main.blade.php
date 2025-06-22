<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title','Data UKM')</title>
  @vite('resources/css/app.css')
  @stack('style')
  <style>
    .sidebar-scroll::-webkit-scrollbar { width: 6px; }
    .sidebar-scroll::-webkit-scrollbar-thumb { background: #38b2ac; border-radius: 6px; }
  </style>
</head>
<body class="bg-gray-100 h-screen overflow-hidden">
  <div class="flex h-full">
    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-teal-700 to-emerald-400 text-white flex flex-col shadow-xl sidebar-scroll overflow-y-auto">
      <div class="flex items-center justify-center h-20 bg-teal-800 shadow">
        <h2 class="text-2xl font-bold tracking-wide flex items-center gap-2">
          <span class="inline-block bg-white/20 rounded-full p-2">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
          </span>
          UKM Panel
        </h2>
      </div>

      <nav class="flex-1 p-6 space-y-2">
        <!-- Tombol Navigasi -->
        <button onclick="window.location='{{ route('ukm.index') }}'"
          class="flex items-center gap-3 w-full rounded-lg px-4 py-2 text-base font-semibold transition
            {{ request()->routeIs('ukm.index') ? 'bg-white text-teal-800 shadow font-bold' : 'text-emerald-50 hover:bg-white/20 hover:text-white' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          UKM
        </button>

        <!-- Dropdown Anggota -->
        <div>
          <button type="button" onclick="toggleDropdown()" id="anggota-btn"
            class="w-full flex justify-between items-center rounded-lg px-4 py-2 text-base font-semibold transition
              {{ request()->routeIs('anggota.index') || request('ukm_id') ? 'bg-white text-teal-800 shadow font-bold' : 'text-emerald-50 hover:bg-white/20 hover:text-white' }}">
            <span class="flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Anggota
            </span>
            <span id="arrow" class="transition-transform">&#9660;</span>
          </button>
          <ul id="dropdown-ukm" class="hidden flex-col mt-1 bg-white/90 rounded-lg shadow-inner border border-emerald-200">
            @foreach($sidebar_ukms as $ukm)
              <li>
                <a href="{{ route('anggota.index', ['ukm_id' => $ukm->id]) }}"
                  class="flex items-center gap-2 px-6 py-2 text-base transition rounded group
                  {{ request('ukm_id') == $ukm->id ? 'bg-emerald-200 text-teal-900 font-bold' : 'text-teal-900 hover:bg-emerald-100 hover:text-teal-900' }}">
                  <svg class="w-3 h-3 text-emerald-400 group-hover:text-emerald-600" fill="currentColor" viewBox="0 0 8 8">
                    <circle cx="4" cy="4" r="3"/>
                  </svg>
                  <span>{{ $ukm->nama_ukm }}</span>
                  @if(request('ukm_id') == $ukm->id)
                    <svg class="w-4 h-4 ml-auto text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  @endif
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        <!-- Tombol Kegiatan -->
        <button onclick="window.location='{{ route('kegiatan.index') }}'"
          class="flex items-center gap-3 w-full rounded-lg px-4 py-2 text-base font-semibold transition
            {{ request()->routeIs('kegiatan.index') ? 'bg-white text-teal-800 shadow font-bold' : 'text-emerald-50 hover:bg-white/20 hover:text-white' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect width="18" height="18" x="3" y="4" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Kegiatan
        </button>

        <!-- Tombol Capaian -->
        <button onclick="window.location='{{ route('capaian.index') }}'"
          class="flex items-center gap-3 w-full rounded-lg px-4 py-2 text-base font-semibold transition
            {{ request()->routeIs('capaian.index') ? 'bg-white text-teal-800 shadow font-bold' : 'text-emerald-50 hover:bg-white/20 hover:text-white' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M8 21h8M12 17v4M7 4h10v4a5 5 0 01-10 0V4z" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17 9a5 5 0 005-5V4a2 2 0 00-2-2H4a2 2 0 00-2 2v0a5 5 0 005 5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Pencapaian
        </button>
      </nav>

      <!-- User Info -->
      <div class="p-6 border-t border-teal-700 bg-teal-800">
        <div class="flex items-center space-x-3">
          <img class="w-10 h-10 rounded-full border-2 border-emerald-300 shadow" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="User">
          <div>
            <p class="text-base font-semibold">Username</p>
            <a href="#" class="text-xs text-emerald-200 hover:text-white">Sign out</a>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-10 bg-gray-50">
      <div class="w-full max-w-7xl mx-auto bg-white rounded-xl shadow p-10">
        @yield('content')
      </div>
    </main>
  </div>

  <script>
    function toggleDropdown() {
      var el = document.getElementById('dropdown-ukm');
      var arrow = document.getElementById('arrow');
      el.classList.toggle('hidden');
      arrow.style.transform = el.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    document.addEventListener('DOMContentLoaded', function () {
      @if(request()->routeIs('anggota.index') || request('ukm_id'))
        toggleDropdown();
      @endif
    });
  </script>
</body>
</html>
