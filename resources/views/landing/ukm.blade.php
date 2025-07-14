@extends('layout.landing')
@section('title', $ukm->nama_ukm)

@push('styles')
<style>
  .ukm-banner {
    background: linear-gradient(to right, #48cae4, #ade8f4);
    padding: 3rem 1rem;
    text-align: center;
    color: #023e8a;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
  }

  .ukm-banner img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  }

  /* Custom Tabs Styling */
  #ukmTabs.nav-tabs {
    justify-content: center;
    margin-top: 2rem;
    border-bottom: none;
    gap: 0.5rem;
  }

  #ukmTabs .nav-link {
    background-color: #e0f7fa;
    color: #0077b6;
    font-weight: 600;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
  }

  #ukmTabs .nav-link:hover {
    background-color: #b5eefa;
    color: #023e8a;
  }

  #ukmTabs .nav-link.active {
    background-color: #00b4d8;
    color: #ffffff;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }

  .tab-content {
    padding-top: 2rem;
  }

  .card-custom {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
  }

  .card-custom:hover {
    transform: translateY(-4px);
  }

  .preview-img {
    max-height: 160px;
    object-fit: cover;
    border-radius: 0.5rem;
  }

  .badge-status {
    font-size: 0.75rem;
    border-radius: 5px;
    padding: 0.3rem 0.6rem;
  }

  .status-upcoming { background-color: #ffe066; color: #5c5c00; }
  .status-ongoing  { background-color: #b2f2bb; color: #2f9e44; }
  .status-done     { background-color: #ced4da; color: #343a40; }
</style>
@endpush

@section('content')
<!-- Header UKM -->
<div class="ukm-banner">
  <img src="{{ asset('storage/' . $ukm->logo_ukm) }}" alt="Logo UKM">
  <h2 class="mt-3">{{ $ukm->nama_ukm }}</h2>
  <p class="mb-1"><strong>Ketua:</strong> {{ $ukm->ketum ?? '-' }}</p>
  <p class="mb-0">Email: {{ $ukm->email ?? '-' }} | Telp: {{ $ukm->telepon ?? '-' }}</p>
  <small><i>Berdiri sejak {{ \Carbon\Carbon::parse($ukm->thn_berdiri)->format('Y') }}</i></small>
</div>

<!-- Tab Navigation -->
<div class="container mb-5">
  <ul class="nav nav-tabs" id="ukmTabs" role="tablist">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#anggota" type="button">Anggota</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kegiatan" type="button">Kegiatan</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#capaian" type="button">Capaian</button>
    </li>
  </ul>

  <div class="tab-content">
    <!-- Tab: Anggota -->
    <div class="tab-pane fade show active" id="anggota">
      <div class="row mt-4">
        @forelse($ukm->anggota as $a)
        <div class="col-md-4 mb-4">
          <div class="card card-custom p-3 text-center">
            <i class="bi bi-person-circle display-4 text-primary mb-2"></i>
            <h5>{{ $a->nama }}</h5>
            <p class="mb-1">NIM: {{ $a->nim }}</p>
            <small class="text-muted">{{ $a->email }}</small>
          </div>
        </div>
        @empty
        <p class="text-muted text-center">Belum ada anggota terdaftar.</p>
        @endforelse
      </div>
    </div>

    <!-- Tab: Kegiatan -->
    <div class="tab-pane fade" id="kegiatan">
      <div class="row mt-4">
        @forelse($ukm->kegiatan as $k)
        <div class="col-md-6 mb-4">
          <div class="card card-custom p-3">
            <h5 class="text-primary">{{ $k->nama_kegiatan }}</h5>
            <div class="d-flex justify-content-between">
              <small>{{ \Carbon\Carbon::parse($k->tgl_kegiatan)->translatedFormat('d M Y') }}</small>
              <span class="badge-status
                @if($k->status == 'Akan Datang') status-upcoming
                @elseif($k->status == 'Sedang Berlangsung') status-ongoing
                @else status-done @endif">
                {{ $k->status }}
              </span>
            </div>
            <p class="mt-2">{{ $k->keterangan ?? '-' }}</p>
            @if($k->dokumentasi)
            <img src="{{ asset('storage/'.$k->dokumentasi) }}" class="preview-img mt-2">
            @endif
          </div>
        </div>
        @empty
        <p class="text-muted text-center">Belum ada kegiatan terdaftar.</p>
        @endforelse
      </div>
    </div>

    <!-- Tab: Capaian -->
    <div class="tab-pane fade" id="capaian">
      <div class="row mt-4">
        @forelse($ukm->capaian as $c)
        <div class="col-md-6 mb-4">
          <div class="card card-custom p-3">
            <h5 class="text-success">{{ $c->judul_prestasi }}</h5>
            <small class="text-muted">
              Oleh: {{ $c->anggota->nama }} |
              {{ \Carbon\Carbon::parse($c->tanggal)->translatedFormat('d M Y') }} |
              {{ $c->tingkat }}
            </small>
            <p class="mt-2">{{ $c->deskripsi_prestasi ?? '-' }}</p>
            @if($c->dokumentasi_capaian)
            <img src="{{ asset('storage/'.$c->dokumentasi_capaian) }}" class="preview-img mt-2">
            @endif
          </div>
        </div>
        @empty
        <p class="text-muted text-center">Belum ada capaian terdaftar.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
