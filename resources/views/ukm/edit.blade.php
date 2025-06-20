@extends('layout.main')
@section('title', 'Edit UKM')
@section('navUkm', 'bg-gray-900 text-white')
@section('content')
<h1 class="text-2xl font-bold mb-4">Input Data UKM</h1>

<form action="{{ route('ukm.update',$ukm->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label for="nama_ukm" class="block font-semibold">Nama UKM</label>
        <input type="text" name="nama_ukm" id="nama_ukm"
            class="border rounded px-3 py-2 w-full @error('nama_ukm') border-red-500 @enderror"
            value="{{ $ukm->nama_ukm }}">
        @error('nama_ukm')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="ketum" class="block font-semibold">Ketua Umum</label>
        <input type="text" name="ketum" id="ketum"
            class="border rounded px-3 py-2 w-full @error('ketum') border-red-500 @enderror"
            value="{{ $ukm->ketum}}" >
        @error('ketum')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="thn_berdiri" class="block font-semibold">Tahun Berdiri</label>
        <input type="date" name="thn_berdiri" id="thn_berdiri"
            class="border rounded px-3 py-2 w-full @error('thn_berdiri') border-red-500 @enderror"
            value="{{ $ukm->thn_berdiri }}" >
        @error('thn_berdiri')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="deskripsi" class="block font-semibold">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"
            class="border rounded px-3 py-2 w-full @error('deskripsi') border-red-500 @enderror"
            rows="4" >{{ $ukm->deskripsi }}</textarea>
        @error('deskripsi')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="logo_ukm" class="block font-semibold">Logo UKM</label>
        <div class="mb-2">
            @if($ukm->logo_ukm)
                <img src="{{ asset('storage/' . $ukm->logo_ukm) }}" alt="Logo UKM" class="h-20 w-20 object-contain rounded shadow">
            @else
                <span class="text-gray-400 italic">Belum ada logo</span>
            @endif
        </div>
        <input type="file" name="logo_ukm" id="logo_ukm"
            class="border rounded px-3 py-2 w-full @error('logo_ukm') border-red-500 @enderror"
            accept="image/*" >
        @error('logo_ukm')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti logo.</p>
    </div>
    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('ukm.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
