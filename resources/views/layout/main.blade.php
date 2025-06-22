<!-- filepath: resources/views/layout/main.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Data UKM')</title>
    @vite('resources/css/app.css')
    @stack('style')

</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
  <!-- Sidebar -->
 <aside class="w-72 bg-gradient-to-b from-teal-600 to-emerald-400 text-white flex flex-col shadow-lg">
  <div class="flex items-center justify-center h-20 bg-teal-800 shadow">
    <h2 class="text-2xl font-bold tracking-wide">UKM Panel</h2>
  </div>
  <nav class="flex-1 p-6 space-y-2">
    <!-- UKM -->
    <button
      onclick="window.location='{{ route('ukm.index') }}'"
      class="flex items-center gap-3 w-full rounded-lg px-4 py-2 text-base font-medium transition
        {{ request()->routeIs('ukm.index') ? 'bg-emerald-200 text-teal-900 shadow font-bold' : 'text-emerald-50 hover:bg-emerald-100 hover:text-teal-900' }}">
      UKM
    </button>
    <!-- Dropdown Anggota tanpa icon dan CDN -->
<div>
  <button type="button"
    onclick="toggleDropdown()"
    id="anggota-btn"
    class="w-full flex justify-between items-center rounded-lg px-4 py-2 text-base font-medium transition
      {{ request()->routeIs('anggota.index') || request('ukm_id') ? 'bg-emerald-300 text-teal-900 font-bold' : 'bg-emerald-50 text-teal-900 hover:bg-emerald-100 hover:text-teal-900' }}">
    Anggota
    <span id="arrow" class="transition-transform">&#9660;</span>
  </button>
    <ul id="dropdown-ukm" class="flex-col mt-1 bg-emerald-100 rounded-lg shadow-inner">
    @foreach($sidebar_ukms as $ukm)
        <li>
        <a href="{{ route('anggota.index', ['ukm_id' => $ukm->id]) }}"
            class="block px-6 py-2 text-base transition
            {{ request('ukm_id') == $ukm->id ? 'bg-emerald-300 text-teal-900 font-bold' : 'text-teal-900 hover:bg-emerald-200 hover:text-teal-900' }}">
            {{ $ukm->nama_ukm }}
        </a>
        </li>
    @endforeach
    </ul>
</div>
    <!-- End Dropdown Anggota -->
    <button
      onclick="window.location='{{ route('kegiatan.index') }}'"
      class="flex items-center gap-3 w-full rounded-lg px-4 py-2 text-base font-medium transition
        {{ request()->routeIs('kegiatan.index') ? 'bg-emerald-200 text-teal-900 shadow font-bold' : 'text-emerald-50 hover:bg-emerald-100 hover:text-teal-900' }}">
      Kegiatan
    </button>
    <button
      onclick="window.location='{{ route('capaian.index') }}'"
      class="flex items-center gap-3 w-full rounded-lg px-4 py-2 text-base font-medium transition
        {{ request()->routeIs('capaian.index') ? 'bg-emerald-200 text-teal-900 shadow font-bold' : 'text-emerald-50 hover:bg-emerald-100 hover:text-teal-900' }}">
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
  <main class="flex-1 p-8 bg-gray-50 min-h-screen">
    @yield('content')
  </main>
</div>
</body>
<script>
 function toggleDropdown() {
    var el = document.getElementById('dropdown-ukm');
    var arrow = document.getElementById('arrow');
    el.classList.toggle('hidden');
    arrow.style.transform = el.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
  }

  // Otomatis buka dropdown jika ada ukm_id di URL (menu aktif)
  document.addEventListener('DOMContentLoaded', function() {
    @if(request()->routeIs('anggota.index') || request('ukm_id'))
      toggleDropdown();
    @endif
  });
</script>
</html>
