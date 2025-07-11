@extends('layout.landing')
@section('title',$ukm->nama_ukm)

@push('styles')
<style>
  .tab-content { padding-top:1rem; }
  .nav-tabs .nav-link {
    color: #0077b6; font-weight: 600; transition: background .3s;
  }
  .nav-tabs .nav-link.active {
    background: #90e0ef; color: #023e8a; border-radius: .375rem;
  }
  .card-anggota, .card-kegiatan, .card-capaian {
    border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: .5rem;
  }
</style>
@endpush

@section('content')
  <!-- Header Info -->
  <section class="py-5 text-center" style="background:#caf0f8;">
    <div class="container">
      <img src="{{ asset('storage/'.$ukm->logo_ukm) }}"
           class="rounded-circle mb-3" style="width:120px;height:120px;object-fit:cover;" alt="">
      <h2 style="color:#0077b6;">{{ $ukm->nama_ukm }}</h2>
      <p class="text-muted">{{ $ukm->ketum ? 'Ketua: '.$ukm->ketum : '' }}</p>
    </div>
  </section>

  <!-- Tabs -->
  <div class="container py-4">
    <ul class="nav nav-tabs justify-content-center" id="detailTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#anggota" type="button">
          Anggota
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kegiatan" type="button">
          Kegiatan
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#capaian" type="button">
          Capaian
        </button>
      </li>
    </ul>
    <div class="tab-content">
      <!-- Anggota -->
      <div class="tab-pane fade show active" id="anggota">
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
          @forelse($ukm->anggota as $a)
          <div class="col">
            <div class="card card-anggota p-3 text-center">
              <i class="fas fa-user fa-2x text-primary mb-2"></i>
              <h6>{{ $a->nama }}</h6>
              <small class="text-muted">{{ $a->jabatan ?? 'Anggota' }}</small>
            </div>
          </div>
          @empty
            <p class="text-center text-muted mt-3">Belum ada anggota.</p>
          @endforelse
        </div>
      </div>
      <!-- Kegiatan -->
      <div class="tab-pane fade" id="kegiatan">
        <div class="mt-3">
          @forelse($ukm->kegiatan as $k)
            <div class="card card-kegiatan mb-3 p-3">
              <h6 class="text-primary mb-1">{{ $k->judul }}</h6>
             
              <p class="mb-0">{{ $k->deskripsi }}</p>
            </div>
          @empty
            <p class="text-center text-muted">Belum ada kegiatan.</p>
          @endforelse
        </div>
      </div>
      <!-- Capaian -->
      <div class="tab-pane fade" id="capaian">
        <div class="mt-3">
          @forelse($ukm->capaian as $c)
            <div class="card card-capaian mb-3 p-3">
              <h6 class="text-primary mb-1">{{ $c->judul }}</h6>
              <small class="text-muted">Tahun: {{ $c->tahun }}</small>
              <p class="mb-0">{{ $c->deskripsi }}</p>
            </div>
          @empty
            <p class="text-center text-muted">Belum ada capaian.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
