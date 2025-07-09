@extends('layout.main')
@section('title', 'Edit Kegiatan')

@section('content')

<h1 class="h4 fw-bold mb-4">Edit Kegiatan UKM</h1>

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

<form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <input type="hidden" name="ukm_id" value="{{ old('ukm_id', $kegiatan->ukm_id) }}">

  <div class="mb-3">
    <label for="nama_kegiatan" class="form-label fw-semibold">Nama Kegiatan</label>
    <input type="text" name="nama_kegiatan" id="nama_kegiatan"
           class="form-control @error('nama_kegiatan') is-invalid @enderror"
           value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}">
    @error('nama_kegiatan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="ukm_display" class="form-label fw-semibold">Kategori UKM</label>
    <select id="ukm_display" disabled class="form-select bg-light">
      @foreach ($ukms as $ukm)
        <option value="{{ $ukm->id }}" {{ $kegiatan->ukm_id == $ukm->id ? 'selected' : '' }}>
          {{ $ukm->nama_ukm }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="anggota_id" class="form-label fw-semibold">Penanggung Jawab (Anggota)</label>
    <select name="anggota_id" id="anggota_id"
            class="form-select @error('anggota_id') is-invalid @enderror">
      <option value="">-- Pilih Anggota --</option>
      @foreach ($anggota as $a)
        <option value="{{ $a->id }}" {{ $kegiatan->anggota_id == $a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
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
           value="{{ old('tgl_kegiatan', $kegiatan->tgl_kegiatan) }}">
    @error('tgl_kegiatan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
    <textarea name="keterangan" id="keterangan" rows="4"
              class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $kegiatan->keterangan) }}</textarea>
    @error('keterangan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="dokumentasi" class="form-label fw-semibold">Dokumentasi</label>
    <div class="mb-2">
      @if ($kegiatan->dokumentasi)
        <img src="{{ asset('storage/' . $kegiatan->dokumentasi) }}" class="img-thumbnail" style="max-width: 100px;">
      @endif
    </div>
    <input type="file" name="dokumentasi" id="dokumentasi" accept="image/*"
           class="form-control @error('dokumentasi') is-invalid @enderror">
    @error('dokumentasi')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah dokumentasi.</small>
  </div>

  <div class="d-flex justify-content-between mt-4">
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('kegiatan.index', ['ukm_id' => $kegiatan->ukm_id]) }}" class="btn btn-outline-secondary">Batal</a>
  </div>

</form>

@endsection
