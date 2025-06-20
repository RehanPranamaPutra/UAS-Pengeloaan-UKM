@extends('layout.main')
@section('title', 'Input UKM')
@section('navUkm', 'bg-gray-900 text-white')
@section('content')
<h1 class="text-2xl font-bold mb-4">Input Data UKM</h1>

<form action="{{ route('ukm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label for="nama_ukm" class="block font-semibold">Nama UKM</label>
        <input type="text" name="nama_ukm" id="nama_ukm"
            class="border rounded px-3 py-2 w-full @error('nama_ukm') border-red-500 @enderror"
            value="{{ old('nama_ukm') }}">
        @error('nama_ukm')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="ketum" class="block font-semibold">Ketua Umum</label>
        <input type="text" name="ketum" id="ketum"
            class="border rounded px-3 py-2 w-full @error('ketum') border-red-500 @enderror"
            value="{{ old('ketum') }}" >
        @error('ketum')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="thn_berdiri" class="block font-semibold">Tahun Berdiri</label>
        <input type="date" name="thn_berdiri" id="thn_berdiri"
            class="border rounded px-3 py-2 w-full @error('thn_berdiri') border-red-500 @enderror"
            value="{{ old('thn_berdiri') }}" >
        @error('thn_berdiri')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="deskripsi" class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"
            class="border rounded px-3 py-2 w-full @error('deskripsi') border-red-500 @enderror"
            rows="4" >{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="logo_ukm" class="block font-semibold">Logo UKM</label>
        <input type="file" name="logo_ukm" id="logo_ukm"
            class="border rounded px-3 py-2 w-full @error('logo_ukm') border-red-500 @enderror"
            accept="image/*" >
        @error('logo_ukm')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('ukm.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
