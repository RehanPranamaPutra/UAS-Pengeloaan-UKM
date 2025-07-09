@extends('layout.main')
@section('title','Data Capaian')
@section('navCapaian','bg-dark text-white')

@section('content')
<h1 class="h4 fw-bold mb-4">Capaian @if ($ukm) - {{ $ukm->nama_ukm }} @endif</h1>

<div class="d-flex justify-content-end mb-3">
  <a href="{{ route('capaian.create',['ukm_id' => $ukm->id]) }}"
     class="btn btn-success">+ Tambah Prestasi</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm">
  <table class="table table-striped table-bordered align-middle">
    <thead class="table-success text-dark">
      <tr>
        <th>Nama UKM</th>
        <th>Nama Anggota</th>
        <th>Prestasi</th>
        <th>Tanggal</th>
        <th>Tingkat</th>
        <th>Dokumentasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($capaian as $item)
      <tr>
        <td>{{ $item->ukm->nama_ukm }}</td>
        <td>{{ $item->anggota->nama ?? '-' }}</td>
        <td>{{ $item->judul_prestasi }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
        <td>{{ $item->tingkat }}</td>
        <td>
          @if($item->dokumentasi_capaian)
            <img src="{{ asset('storage/' . $item->dokumentasi_capaian) }}" class="img-thumbnail" style="max-width: 60px;">
          @else
            <span class="text-muted fst-italic">Tidak ada logo</span>
          @endif
        </td>
        <td>
          <div class="d-flex gap-2">
            <a href="{{ route('capaian.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('capaian.delete', $item->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus {{ $item->judul_prestasi }} ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </div>
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

<div class="mt-3">
  {{ $capaian->withQueryString()->links() }}
</div>
@endsection
