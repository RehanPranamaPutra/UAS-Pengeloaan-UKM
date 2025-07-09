@extends('layout.main')
@section('title', 'Edit UKM')
@section('navUkm', 'active')

@section('content')
<h1 class="fs-4 fw-bold mb-4">Edit Data UKM</h1>

<form action="{{ route('ukm.update', $ukm->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama_ukm" class="form-label fw-semibold">Nama UKM</label>
        <input type="text" name="nama_ukm" id="nama_ukm"
            class="form-control @error('nama_ukm') is-invalid @enderror"
            value="{{ $ukm->nama_ukm }}">
        @error('nama_ukm')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="ketum" class="form-label fw-semibold">Ketua Umum</label>
        <input type="text" name="ketum" id="ketum"
            class="form-control @error('ketum') is-invalid @enderror"
            value="{{ $ukm->ketum }}">
        @error('ketum')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="thn_berdiri" class="form-label fw-semibold">Tahun Berdiri</label>
        <input type="date" name="thn_berdiri" id="thn_berdiri"
            class="form-control @error('thn_berdiri') is-invalid @enderror"
            value="{{ $ukm->thn_berdiri }}">
        @error('thn_berdiri')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"
            class="form-control @error('deskripsi') is-invalid @enderror"
            rows="4">{{ $ukm->deskripsi }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="logo_ukm" class="form-label fw-semibold">Logo UKM</label>
        <div class="mb-2">
            @if($ukm->logo_ukm)
                <img src="{{ asset('storage/' . $ukm->logo_ukm) }}" alt="Logo UKM" class="img-thumbnail" style="height: 80px; width: 80px; object-fit: contain;">
            @else
                <span class="text-muted fst-italic">Belum ada logo</span>
            @endif
        </div>
        <input type="file" name="logo_ukm" id="logo_ukm"
            class="form-control @error('logo_ukm') is-invalid @enderror"
            accept="image/*">
        @error('logo_ukm')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Kosongkan jika tidak ingin mengganti logo.</div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('ukm.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </div>
</form>
@endsection
