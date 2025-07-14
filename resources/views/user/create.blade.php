@extends('layout.main')
@section('title', 'Tambah User')
@section('navUser', 'active')

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="mb-0">Tambah User Baru</h5>
  </div>
  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password"
               name="password_confirmation"
               class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Peran</label>
        <select name="role"
                id="roleSelect"
                class="form-select @error('role') is-invalid @enderror">
          <option value="">-- Pilih Role --</option>
          <option value="admin"    {{ old('role')=='admin' ? 'selected':'' }}>Admin</option>
          <option value="pengelola"{{ old('role')=='pengelola' ? 'selected':'' }}>Pengelola</option>
        </select>
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Pilih UKM</label>
        <select name="ukm_id"
                id="ukmSelect"
                class="form-select @error('ukm_id') is-invalid @enderror">
          <option value="">-- Pilih UKM --</option>
          @foreach($ukms as $u)
            <option value="{{ $u->id }}" {{ old('ukm_id')==$u->id ? 'selected':'' }}>
              {{ $u->nama_ukm }}
            </option>
          @endforeach
        </select>
        @error('ukm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('roleSelect');
    const ukmSelect  = document.getElementById('ukmSelect');

    function toggleUKM() {
      ukmSelect.disabled = (roleSelect.value !== 'pengelola');
    }
    roleSelect.addEventListener('change', toggleUKM);
    toggleUKM(); // inisialisasi sesuai old('role')
  });
</script>
@endpush
