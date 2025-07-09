@extends('layout.main')
@section('title', 'Input UKM')
@section('navUkm', 'active') {{-- Sesuaikan dengan kelas aktif di Bootstrap jika perlu --}}
@section('content')
<h1 class="h4 fw-bold mb-4">Input Data UKM</h1>

<form action="{{ route('ukm.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nama_ukm" class="form-label fw-semibold">Nama UKM</label>
        <input type="text" name="nama_ukm" id="nama_ukm"
            class="form-control @error('nama_ukm') is-invalid @enderror"
            value="{{ old('nama_ukm') }}">
        @error('nama_ukm')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="ketum" class="form-label fw-semibold">Ketua Umum</label>
        <input type="text" name="ketum" id="ketum"
            class="form-control @error('ketum') is-invalid @enderror"
            value="{{ old('ketum') }}">
        @error('ketum')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" id="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="thn_berdiri" class="form-label fw-semibold">Tahun Berdiri</label>
        <input type="date" name="thn_berdiri" id="thn_berdiri"
            class="form-control @error('thn_berdiri') is-invalid @enderror"
            value="{{ old('thn_berdiri') }}">
        @error('thn_berdiri')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="telepon" class="form-label fw-semibold">Telepon</label>
        <input type="text" name="telepon" id="telepon"
            class="form-control @error('telepon') is-invalid @enderror"
            value="{{ old('telepon') }}">
        @error('telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="website" class="form-label fw-semibold">Website</label>
        <input type="text" name="website" id="website"
            class="form-control @error('website') is-invalid @enderror"
            value="{{ old('website') }}">
        @error('website')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"
            class="form-control @error('deskripsi') is-invalid @enderror"
            rows="4">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="logo_ukm" class="form-label fw-semibold">Logo UKM</label>
        <input type="file" name="logo_ukm" id="logo_ukm"
            class="form-control @error('logo_ukm') is-invalid @enderror"
            accept="image/*">
        @error('logo_ukm')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('ukm.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </div>
</form>
@endsection
