@extends('layout.main')
@section('title','Create Data Anggota')
@section('content')
<h1 class="text-2xl font-bold mb-4">Input Data UKM</h1>

<form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label for="nama" class="block font-semibold">Nama Anggota</label>
        <input type="text" name="nama" id="nama"
            class="border rounded px-3 py-2 w-full @error('nama') border-red-500 @enderror"
            value="{{ old('nama') }}">
        @error('nama')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="nim" class="block font-semibold">NIM</label>
        <input type="text" name="nim" id="nim"
            class="border rounded px-3 py-2 w-full @error('nim') border-red-500 @enderror"
            value="{{ old('nim') }}" >
        @error('nim')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email" class="block font-semibold">Email</label>
        <input type="email" name="email" id="email"
            class="border rounded px-3 py-2 w-full @error('email') border-red-500 @enderror"
            value="{{ old('email') }}" >
        @error('email')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
    <label for="ukm_id" class="block font-semibold">Kategori UKM</label>
    <select name="ukm_id" id="ukm_id"
        class="disable border rounded px-3 py-2 w-full bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 @error('ukm_id') border-red-500 @enderror">
        <option value="">-- Pilih UKM --</option>
        @foreach ($ukms as $ukm)
            <option value="{{ $ukm->id }}"
                {{ old('ukm_id',$select_ukm_id ?? '') == $ukm->id ? 'selected' : '' }}>
                {{ $ukm->nama_ukm }}
            </option>
        @endforeach
    </select>
    @error('ukm_id')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('ukm.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
