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
    <form action="{{ route('capaian.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-semibold">Prestasi</label>
        <input type="text" name="judul_prestasi" value="{{ old('judul_prestasi') }}" class="form-control @error('judul_prestasi') is-invalid @enderror">
        @error('judul_prestasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- UKM Select -->
      <div class="mb-3">
        <label class="form-label fw-semibold">UKM</label>
        <select class="form-select bg-light" disabled>
          @foreach($ukms as $ukm)
            <option value="{{ $ukm->id }}" {{ request('ukm_id') == $ukm->id ? 'selected' : '' }}>{{ $ukm->nama_ukm }}</option>
          @endforeach
        </select>
        <input type="hidden" name="ukm_id" value="{{ request('ukm_id') }}">
      </div>

      <!-- Anggota -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Penanggung Jawab (Anggota)</label>
        <select name="anggota_id" id="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror">
          <option value="">Pilih Anggota</option>
          @foreach ($anggotas as $anggota)
            <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>{{ $anggota->nama }}</option>
          @endforeach
        </select>
        @error('anggota_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Tanggal -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Tanggal Prestasi</label>
        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror">
        @error('tanggal')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Tingkat -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Tingkat</label>
        <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror">
          <option value="">Pilih Tingkat</option>
          <option value="Kampus" {{ old('tingkat') == 'Kampus' ? 'selected' : '' }}>Kampus</option>
          <option value="Regional" {{ old('tingkat') == 'Regional' ? 'selected' : '' }}>Regional</option>
          <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
          <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
        </select>
        @error('tingkat')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Deskripsi -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Keterangan</label>
        <textarea name="deskripsi_prestasi" rows="4" class="form-control @error('deskripsi_prestasi') is-invalid @enderror">{{ old('deskripsi_prestasi') }}</textarea>
        @error('deskripsi_prestasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Upload -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Upload Dokumentasi</label>
        <input type="file" name="dokumentasi_capaian" accept="image/*" class="form-control @error('dokumentasi_capaian') is-invalid @enderror">
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

{{-- Optional: Script AJAX tetap dipertahankan --}}
<script>
  
</script>

@endsection
