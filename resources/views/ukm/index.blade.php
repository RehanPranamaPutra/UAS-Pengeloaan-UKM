@extends('layout.main')
@section('title', 'Data UKM')
@section('navUkm', 'bg-gray-900 text-white')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-center">Daftar UKM</h1>
<a href="{{ route('ukm.create') }}" class="inline-block mb-6 px-6 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
    + Tambah Data UKM
</a>
<div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
        <thead class="bg-blue-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama UKM</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Ketua Umum</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Tahun Berdiri</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Logo</th>
                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ukms as $ukm)
            <tr class="border-b hover:bg-blue-50 transition">
                <td class="px-6 py-4">{{ $ukm->nama_ukm }}</td>
                <td class="px-6 py-4">{{ $ukm->ketum }}</td>
                <td class="px-6 py-4">{{ $ukm->thn_berdiri }}</td>
                <td class="px-6 py-4 max-w-xs truncate" title="{{ $ukm->deskripsi }}">{{ Str::limit($ukm->deskripsi, 50) }}</td>
                <td class="px-6 py-4">
                    @if($ukm->logo_ukm)
                        <img src="{{ asset('storage/' . $ukm->logo_ukm) }}"
                            alt="Logo {{ $ukm->nama_ukm }}"
                            class="h-12 w-12 object-contain rounded shadow">
                    @else
                        <span class="text-gray-400 italic">Tidak ada logo</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('ukm.edit',$ukm->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <span class="mx-2 text-gray-400">|</span>
                    <form action="{{ route('ukm.delete', $ukm->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 m-0 cursor-pointer">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data UKM.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
