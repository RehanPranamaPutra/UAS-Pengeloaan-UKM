@extends('layout.landing')
@section('title','Daftar UKM')

@push('styles')
<style>
  /* Hero full-screen */
  #hero {
    height: 100vh;
    background: linear-gradient(135deg, #90e0ef, #caf0f8), url('{{ asset('image.png') }}') center/cover no-repeat;
    display: flex; align-items: center; justify-content: center; text-align: center;
    color: #023e8a;
  }
  #hero h1 { font-size: 3.5rem; font-weight: 700; }
  #hero p  { font-size: 1.25rem; margin-bottom: 1.5rem; }
  #hero .btn-hero {
    background: #ffd60a; color: #023e8a; font-weight: 600; padding: .6rem 1.8rem;
    border-radius: 50px; transition: background .3s;
  }
  #hero .btn-hero:hover { background: #ffec99; }
</style>
@endpush

@section('content')
  <!-- Hero -->
  <section id="hero">
    <div class="container hero-content">
      <h1>Selamat Datang di Portal UKM</h1>
      <p>Jelajahi Unit Kegiatan Mahasiswa dengan mudah dan cepat.</p>
      <a href="#ukm" class="btn btn-hero">Lihat UKM</a>
    </div>
  </section>

  <!-- Daftar UKM -->
  <section id="ukm" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4" style="color:#0077b6;">Daftar UKM</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($ukms as $ukm)
        <div class="col">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('storage/'.$ukm->logo_ukm) }}"
                 class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $ukm->nama_ukm }}">
            <div class="card-body">
              <h5 class="card-title" style="color:#0077b6;">{{ $ukm->nama_ukm }}</h5>
              <p class="card-text text-muted">{{ Str::limit($ukm->deskripsi, 60) }}</p>
              <a href="{{ route('landing.ukm.detail',$ukm->slug) }}" class="btn btn-outline-primary btn-sm">
                Lihat Detail
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      @if($ukms->isEmpty())
        <div class="alert alert-warning text-center mt-4">Belum ada UKM terdaftar.</div>
      @endif
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-4 bg-light">
    <div class="container text-center">
      <h5 style="color:#0077b6;">Kontak Kami</h5>
      <p class="mb-0">Email: <strong>info@kampus.ac.id</strong> | Telp: <strong>(031) 1234567</strong></p>
    </div>
  </section>
@endsection
