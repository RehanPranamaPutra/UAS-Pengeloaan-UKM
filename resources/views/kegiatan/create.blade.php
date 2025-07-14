@extends('layout.main')
@section('title', 'Tambah Kegiatan')
@section('content')

<h1 class="h4 fw-bold mb-4">Tambah Kegiatan UKM</h1>

@if ($errors->any())
  <div class="alert alert-danger">
    <strong>Terjadi kesalahan:</strong>
    <ul class="mb-0 mt-2 ps-3">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="nama_kegiatan" class="form-label fw-semibold">Nama Kegiatan</label>
    <input type="text" name="nama_kegiatan" id="nama_kegiatan"
           class="form-control @error('nama_kegiatan') is-invalid @enderror"
           value="{{ old('nama_kegiatan') }}">
    @error('nama_kegiatan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <input type="hidden" name="ukm_id" value="{{ old('ukm_id', $select_ukm_id) }}">

  <div class="mb-3">
    <label for="ukm_display" class="form-label fw-semibold">Kategori UKM</label>
    <select id="ukm_display" disabled class="form-select bg-light">
      @foreach ($ukms as $ukm)
        <option value="{{ $ukm->id }}" {{ old('ukm_id', $select_ukm_id) == $ukm->id ? 'selected' : '' }}>
          {{ $ukm->nama_ukm }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="anggota_id" class="form-label fw-semibold">Penanggung Jawab (Anggota)</label>
    <select name="anggota_id" id="anggota_id"
            class="form-select @error('anggota_id') is-invalid @enderror">
      <option value="">Pilih Anggota</option>
      @foreach ($anggotas as $anggota)
        <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
          {{ $anggota->nama }}
        </option>
      @endforeach
    </select>
    @error('anggota_id')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="tgl_kegiatan" class="form-label fw-semibold">Tanggal Kegiatan</label>
    <input type="date" name="tgl_kegiatan" id="tgl_kegiatan"
           class="form-control @error('tgl_kegiatan') is-invalid @enderror"
           value="{{ old('tgl_kegiatan') }}">
    @error('tgl_kegiatan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
    <textarea name="keterangan" id="keterangan" rows="4"
              class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
    @error('keterangan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="dokumentasi" class="form-label fw-semibold">Upload Dokumentasi</label>
    <input type="file" name="dokumentasi" id="dokumentasi"
           class="form-control @error('dokumentasi') is-invalid @enderror" accept="image/*">
    @error('dokumentasi')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="d-flex justify-content-between mt-4">
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">Batal</a>
  </div>

</form>
@endsection
