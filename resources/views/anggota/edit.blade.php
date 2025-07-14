@extends('layout.main')
@section('title','Edit Anggota')

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="mb-0">Edit Data Anggota</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('anggota.update',$anggota->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="nama" class="form-label">Nama Anggota</label>
        <input type="text" name="nama" id="nama"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $anggota->nama) }}">
        @error('nama')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" name="nim" id="nim"
               class="form-control @error('nim') is-invalid @enderror"
               value="{{ old('nim', $anggota->nim) }}">
        @error('nim')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $anggota->email) }}">
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="ukm_id" class="form-label">Kategori UKM</label>

        {{-- Select: hanya tampilan, tapi disabled --}}
        <select class="form-select" id="ukm_id" disabled>
            <option value="">-- Pilih UKM --</option>
            @foreach ($ukms as $ukm)
            <option value="{{ $ukm->id }}"
                {{ old('ukm_id', $select_ukm_id ?? $anggota->ukm_id ) == $ukm->id ? 'selected' : '' }}>
                {{ $ukm->nama_ukm }}
            </option>
            @endforeach
        </select>

        {{-- Hidden input: agar tetap terkirim ke server meskipun select-nya disabled --}}
        <input type="hidden" name="ukm_id" value="{{ old('ukm_id', $select_ukm_id ?? $anggota->ukm_id) }}">
        </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
