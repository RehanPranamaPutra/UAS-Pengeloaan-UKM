@extends('layout.main')
@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <strong>Terjadi kesalahan:</strong>
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card shadow-sm">
  <div class="card-body">
    <form action="{{ route('capaian.update', $capaian->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label fw-semibold">Prestasi</label>
        <input type="text" name="judul_prestasi" value="{{ old('judul_prestasi', $capaian->judul_prestasi) }}"
          class="form-control @error('judul_prestasi') is-invalid @enderror">
        @error('judul_prestasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <input type="hidden" name="ukm_id" value="{{ $ukm?->id }}">

      <div class="mb-3">
        <label class="form-label fw-semibold">UKM</label>
        <select class="form-select bg-light" disabled>
          @foreach($ukms as $item)
            <option value="{{ $item->id }}" {{ $item->id == $ukm?->id ? 'selected' : '' }}>
              {{ $item->nama_ukm }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Anggota</label>
        <select name="anggota_id" id="anggota_id"
          class="form-select @error('anggota_id') is-invalid @enderror">
          @foreach($anggotas as $anggota)
            <option value="{{ $anggota->id }}" {{ $anggota->id == old('anggota_id', $capaian->anggota_id) ? 'selected' : '' }}>
              {{ $anggota->nama }}
            </option>
          @endforeach
        </select>
        @error('anggota_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Tanggal Prestasi</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', $capaian->tanggal) }}"
          class="form-control @error('tanggal') is-invalid @enderror">
        @error('tanggal')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Tingkat</label>
        <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror">
          <option value="">Pilih Tingkat</option>
          @php
            $tingkatOptions = ['Kampus', 'Regional', 'Nasional', 'Internasional'];
            $selectedTingkat = old('tingkat', $capaian->tingkat ?? '');
          @endphp
          @foreach ($tingkatOptions as $tingkat)
            <option value="{{ $tingkat }}" {{ $selectedTingkat == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
          @endforeach
        </select>
        @error('tingkat')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Keterangan</label>
        <textarea name="deskripsi_prestasi" rows="4"
          class="form-control @error('deskripsi_prestasi') is-invalid @enderror">{{ old('deskripsi_prestasi', $capaian->deskripsi_prestasi) }}</textarea>
        @error('deskripsi_prestasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Dokumentasi</label>
        <div class="mb-2">
          @if($capaian->dokumentasi_capaian)
            <img src="{{ asset('storage/' . $capaian->dokumentasi_capaian) }}" class="img-thumbnail" style="max-height: 100px;">
          @else
            <span class="text-muted fst-italic">Belum ada dokumentasi</span>
          @endif
        </div>
        <input type="file" name="dokumentasi_capaian" class="form-control @error('dokumentasi_capaian') is-invalid @enderror" accept="image/*">
        <div class="form-text">Kosongkan jika tidak ingin mengganti dokumentasi.</div>
        @error('dokumentasi_capaian')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex justify-content-between pt-3">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>



@endsection
