@extends('layout.main')

@section('title', 'Data UKM') {{-- ini untuk <title> di head --}}
@section('navUkm', 'bg-gray-900 text-white') {{-- ini bisa dipakai untuk nav aktif --}}

@section('content')
<h1 class="text-2xl font-bold mb-4">UKM</h1>
<table class="table-auto w-full border">
  <thead class="bg-gray-200">
    <tr>
      <th class="border px-4 py-2">Nama UKM</th>
      <th class="border px-4 py-2">Ketua Umum</th>
      <th class="border px-4 py-2">Tahun Berdiri</th>
      <th class="border px-4 py-2">Deskripsi</th>
      <th class="border px-4 py-2">Logo</th>
      <th class="border px-4 py-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        @foreach ($ukms as $ukm)
        <td>{{ $ukm->nama_ukm }}</td>
        <td>{{ $ukm->ketum }}</td>
        <td>{{ $ukm->thn_berdiri }}</td>
        <td>{{ $ukm->deskripsi }}</td>
        <td>{{ $ukm->logo }}</td>u
        @endforeach
    </tr>
  </tbody>
</table>
@endsection
