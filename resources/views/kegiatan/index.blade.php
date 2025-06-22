@extends('layout.main')
@section('title', 'Data Kegiatan UKM')
@section('content')

<h1 class="text-2xl font-bold mb-4">Data Kegiatan UKM</h1>

<!-- Filter Form -->
{{-- <form method="GET" action="{{ route('kegiatan.index') }}" class="mb-6">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <!-- Filter UKM -->
    <div>
      <label class="block text-sm font-semibold mb-1">UKM</label>
      <select name="ukm_id" class="w-full border-gray-300 rounded">
        <option value="">Semua UKM</option>
        @foreach($list_ukm as $ukm)
          <option value="{{ $ukm->id }}" {{ request('ukm_id') == $ukm->id ? 'selected' : '' }}>
            {{ $ukm->nama_ukm }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Tanggal Awal -->
    <div>
      <label class="block text-sm font-semibold mb-1">Tanggal Awal</label>
      <input type="date" name="tanggal_awal" class="w-full border-gray-300 rounded"
             value="{{ request('tanggal_awal') }}">
    </div>

    <!-- Tanggal Akhir -->
    <div>
      <label class="block text-sm font-semibold mb-1">Tanggal Akhir</label>
      <input type="date" name="tanggal_akhir" class="w-full border-gray-300 rounded"
             value="{{ request('tanggal_akhir') }}">
    </div>

    <!-- Tombol -->
    <div class="flex items-end gap-2">
      <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded">Filter</button>
      <a href="{{ route('kegiatan.index') }}" class="text-sm text-teal-700 hover:underline">Reset</a>
    </div>
  </div>
</form> --}}

<!-- Tombol Tambah -->
<div class="flex justify-end mb-4">
  <a href="{{ route('kegiatan.create') }}"
     class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">+ Tambah Kegiatan</a>
</div>

<!-- Tabel Kegiatan -->
<div class="overflow-x-auto bg-white rounded shadow">
  <table class="min-w-full table-auto">
    <thead class="bg-teal-600 text-white">
      <tr>
        <th class="px-4 py-2 text-left">Nama Kegiatan</th>
        <th class="px-4 py-2 text-left">Tanggal</th>
        <th class="px-4 py-2 text-left">UKM</th>
        <th class="px-4 py-2 text-left">Penanggung Jawab</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($kegiatan as $item)
        <tr class="border-b">
          <td class="px-4 py-2">{{ $item->nama_kegiatan }}</td>
          <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tgl_kegiatan)->format('d M Y') }}</td>
          <td class="px-4 py-2">{{ $item->ukm->nama_ukm ?? '-' }}</td>
          <td class="px-4 py-2">{{ $item->anggota->nama ?? '-' }}</td>
          <td class="px-4 py-2">
            <span class="px-2 py-1 rounded text-sm font-medium
              {{
                $item->status === 'Akan Datang' ? 'bg-yellow-100 text-yellow-800' :
                ($item->status === 'Sedang Berlangsung' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800')
              }}">
              {{ $item->status }}
            </span>
          </td>
          <td class="px-4 py-2 flex gap-2">
            <a href="{{ route('kegiatan.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
            <form action="{{ route('kegiatan.delete', $item->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada data kegiatan.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- Pagination -->
<div class="mt-4">
  {{ $kegiatan->withQueryString()->links() }}
</div>

@endsection
