@extends('layout.main')
@section('title', 'Data Kegiatan UKM')

@section('content')
<h1 class="h4 fw-bold mb-4">Data Kegiatan UKM</h1>

<!-- Tombol Tambah -->
<div class="d-flex justify-content-end mb-3">
  <a href="{{ route('kegiatan.create',['ukm_id' => $ukm->id]) }}" class="btn btn-success">
    + Tambah Kegiatan
  </a>
</div>

<!-- Tabel Kegiatan -->
<div class="table-responsive bg-white rounded shadow-sm p-2">
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-success text-center">
      <tr>
        <th>Nama Kegiatan</th>
        <th>Tanggal</th>
        <th>UKM</th>
        <th>Penanggung Jawab</th>
        <th>Dokumentasi</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($kegiatan as $item)
        <tr>
          <td>{{ $item->nama_kegiatan }}</td>
          <td>{{ \Carbon\Carbon::parse($item->tgl_kegiatan)->format('d M Y') }}</td>
          <td>{{ $item->ukm->nama_ukm ?? '-' }}</td>
          <td>{{ $item->anggota->nama ?? '-' }}</td>
          <td>
            @if($item->dokumentasi)
              <img src="{{ asset('storage/' . $item->dokumentasi) }}" alt="Dokumentasi"
                   class="img-thumbnail" style="max-width: 60px;">
            @else
              <span class="text-muted fst-italic">Tidak ada dokumentasi</span>
            @endif
          </td>
          <td>
            @php
              $statusClass = match($item->status) {
                'Akan Datang' => 'badge bg-warning text-dark',
                'Sedang Berlangsung' => 'badge bg-primary',
                default => 'badge bg-success'
              };
            @endphp
            <span class="{{ $statusClass }}">{{ $item->status }}</span>
          </td>
          <td class="text-nowrap">
            <a href="{{ route('kegiatan.edit', ['kegiatan' => $item->id, 'ukm_id' => request('ukm_id')]) }}"
               class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('kegiatan.delete', $item->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted">Tidak ada data kegiatan.</td>
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
