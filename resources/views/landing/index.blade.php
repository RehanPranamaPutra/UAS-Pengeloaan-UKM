@extends('layout.landing')
@section('title','Daftar UKM')

@push('styles')
<style>
  /* Animasi Fade In */
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(40px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  #hero {
    height: 100vh;
    background: url('{{ asset('image.png') }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #023e8a;
    position: relative;
    animation: fadeInUp 1.2s ease-out;
  }

  #hero .hero-content {
    max-width: 700px;
    padding: 2rem;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }

  #hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
  }

  #hero p {
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
  }

  .btn-hero {
    background: #ffd60a;
    color: #023e8a;
    font-weight: 600;
    padding: .6rem 1.8rem;
    border-radius: 50px;
    transition: all .3s ease;
    border: none;
  }

  .btn-hero:hover {
    background: #ffec99;
    transform: scale(1.05);
  }

  .card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 119, 182, 0.15);
  }
   .object-fit-cover {
    object-fit: cover;
  }

  .transition {
    transition: transform 0.3s ease;
  }

  .card:hover .transition {
    transform: scale(1.05);
  }

  .hover-shadow:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  }

   .ukm-image {
    max-height: 200px;
    object-fit: contain;
  }

  .hover-shadow:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: 0.3s ease;
  }
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
    <div class="container py-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($ukms as $ukm)
        <div class="col">
        <div class="card h-100 border-0 shadow-sm hover-shadow rounded-4">
            <div class="d-flex align-items-center justify-content-center bg-white" style="height: 220px;">
            <img src="{{ asset('storage/'.$ukm->logo_ukm) }}"
                class="img-fluid ukm-image"
                alt="{{ $ukm->nama_ukm }}">
            </div>
            <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold text-primary">{{ $ukm->nama_ukm }}</h5>
            <p class="card-text text-muted flex-grow-1">
                {{ Str::limit($ukm->deskripsi, 80) }}
            </p>
            <div class="mt-2">
                <a href="{{ route('landing.ukm.detail', $ukm->slug) }}"
                class="btn btn-outline-primary btn-sm rounded-pill w-100">
                Lihat Detail
                </a>
            </div>
            </div>
        </div>
        </div>
        @endforeach
    </div>
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
