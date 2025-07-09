@extends('layout.main')
@section('title','Create Data Anggota')
@section('navAnggota', 'active')
@section('navAnggotaParent', 'active')
@section('content')
<h1 class="fs-4 fw-bold mb-4">Input Data UKM</h1>

<form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nama" class="form-label fw-semibold">Nama Anggota</label>
        <input type="text" name="nama" id="nama"
            class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama') }}">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nim" class="form-label fw-semibold">NIM</label>
        <input type="text" name="nim" id="nim"
            class="form-control @error('nim') is-invalid @enderror"
            value="{{ old('nim') }}">
        @error('nim')
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

    <div class="mb-3" >
        <label  for="ukm_id" class="form-label fw-semibold">Kategori UKM</label>
        <select name="ukm_id" id="ukm_id" disabled
            class="form-select @error('ukm_id') is-invalid @enderror">
            <option value="">-- Pilih UKM --</option>
            @foreach ($ukms as $ukm)
                <option value="{{ $ukm->id }}"
                    {{ old('ukm_id', $select_ukm_id ?? '') == $ukm->id ? 'selected' : '' }}>
                    {{ $ukm->nama_ukm }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="ukm_id" value="{{ old('ukm_id', $select_ukm_id ?? '') }}">
        @error('ukm_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
