@extends('layout.main')
@section('title', 'Tambah Kegiatan')
@section('content')

<h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Kegiatan UKM</h1>

@if ($errors->any())
  <div class="mb-6 bg-red-100 text-red-700 p-4 rounded shadow">
    <strong>Terjadi kesalahan:</strong>
    <ul class="mt-2 list-disc list-inside text-sm">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div>
  <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
      <label class="block mb-1 text-gray-700 font-semibold">Nama Kegiatan</label>
      <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
        class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500
        {{ $errors->has('nama_kegiatan') ? 'border-red-500' : 'border-gray-300' }}">
      @error('nama_kegiatan')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block mb-1 text-gray-700 font-semibold">UKM</label>
      <select name="ukm_id" id="ukm_id"
        class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500
        {{ $errors->has('ukm_id') ? 'border-red-500' : 'border-gray-300' }}">
        <option value="">Pilih UKM</option>
        @foreach($ukms as $ukm)
          <option value="{{ $ukm->id }}" {{ old('ukm_id') == $ukm->id ? 'selected' : '' }}>{{ $ukm->nama_ukm }}</option>
        @endforeach
      </select>
      @error('ukm_id')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block mb-1 text-gray-700 font-semibold">Penanggung Jawab (Anggota)</label>
      <select name="anggota_id" id="anggota_id"
        class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500
        {{ $errors->has('anggota_id') ? 'border-red-500' : 'border-gray-300' }}">
        <option value="">Pilih anggota sesuai UKM</option>
      </select>
      @error('anggota_id')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block mb-1 text-gray-700 font-semibold">Tanggal Kegiatan</label>
      <input type="date" name="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}"
        class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500
        {{ $errors->has('tgl_kegiatan') ? 'border-red-500' : 'border-gray-300' }}">
      @error('tgl_kegiatan')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block mb-1 text-gray-700 font-semibold">Keterangan</label>
      <textarea name="keterangan" rows="4"
        class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500
        {{ $errors->has('keterangan') ? 'border-red-500' : 'border-gray-300' }}">{{ old('keterangan') }}</textarea>
      @error('keterangan')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="block mb-1 text-gray-700 font-semibold">Upload Dokumentasi</label>
      <input type="file" name="dokumentasi"
        class="w-full border rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-teal-500
        {{ $errors->has('dokumentasi') ? 'border-red-500' : 'border-gray-300' }}" accept="image/*">
      @error('dokumentasi')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex justify-between items-center pt-4">
      <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-6 py-2 rounded-md shadow">
        Simpan
      </button>
      <a href="{{ route('kegiatan.index') }}" class="text-teal-700 hover:underline">Batal</a>
    </div>
  </form>
</div>

{{-- Script AJAX untuk load anggota berdasarkan UKM --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const ukmSelect = document.getElementById('ukm_id');
    const anggotaSelect = document.getElementById('anggota_id');
    const oldAnggotaId = "{{ old('anggota_id') }}";

    function loadAnggota(ukmId) {
      anggotaSelect.innerHTML = '<option value="">Memuat...</option>';
      fetch(`/admin/get-anggota-by-ukm/${ukmId}`)
        .then(response => {
          if (!response.ok) throw new Error('Gagal mengambil data');
          return response.json();
        })
        .then(data => {
          anggotaSelect.innerHTML = '<option value="">Pilih Anggota</option>';
          data.forEach(item => {
            const selected = (item.id == oldAnggotaId) ? 'selected' : '';
            anggotaSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
          });
        })
        .catch(error => {
          anggotaSelect.innerHTML = '<option value="">Gagal memuat anggota</option>';
          console.error(error);
        });
    }

    if (ukmSelect.value) {
      loadAnggota(ukmSelect.value);
    }

    ukmSelect.addEventListener('change', function () {
      if (this.value) {
        loadAnggota(this.value);
      } else {
        anggotaSelect.innerHTML = '<option value="">Pilih anggota sesuai UKM</option>';
      }
    });
  });
</script>

@endsection
