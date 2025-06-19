<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Data UKM')</title>
    @vite('resources/css/app.css')
    @stack('style')
</head>
<body>
   <div class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="flex items-center justify-center h-16 bg-gray-900">
      <h2>UKM</h2>
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('ukm.index') }}"
         class="block rounded-md px-4 py-2 text-sm font-medium
                {{ request()->routeIs('ukm.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        UKM
      </a>
      <a href="{{ route('kegiatan.index') }}"
         class="block rounded-md px-4 py-2 text-sm font-medium
                {{ request()->routeIs('kegiatan.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Kegiatan
      </a>
      <a href="{{ route('anggota.index') }}"
         class="block rounded-md px-4 py-2 text-sm font-medium
                {{ request()->routeIs('anggota.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Anggota
      </a>
      <a href="{{ route('capaian.index') }}"
         class="block rounded-md px-4 py-2 text-sm font-medium
                {{ request()->routeIs('capaian.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        Pencapaian
      </a>
    </nav>
    <!-- Optional: user info / logout at bottom -->
    <div class="p-4 border-t border-gray-700">
      <div class="flex items-center space-x-3">
        <img class="w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="User">
        <div>
          <p class="text-sm font-medium">Username</p>
          <a href="#" class="text-xs text-gray-400 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    @yield('content')
  </main>
</div>

</body>
</html>
