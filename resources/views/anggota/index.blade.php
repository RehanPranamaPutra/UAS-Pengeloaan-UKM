@extends('layout.main')

@section('title','Data Anggota')
@section('navAnggota','bg-gray-900 text-white')
@section('content')
<h1>Anggota
    @if ($ukm)
        - {{ $ukm->nama_ukm }}
    @endif
</h1>

<a href="{{ route('anggota.create', ['ukm_id' => $ukm->id]) }}" class="inline-block mb-6 px-6 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
    + {{ $ukm->nama_ukm }}
</a>
@if($ukm && $anggotas->count())
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <!-- table head & body -->
        </table>
    </div>
@elseif($ukm)
    <div class="text-gray-500 mt-4">Belum ada anggota untuk UKM ini.</div>
@endif
<div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
        <thead class="bg-blue-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">NIM</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">UKM</th>
                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($anggotas as $anggota)
            <tr class="border-b hover:bg-blue-50 transition">
                <td class="px-6 py-4">{{ $anggota->nama }}</td>
                <td class="px-6 py-4">{{ $anggota->nim }}</td>
                <td class="px-6 py-4">{{ $anggota->email }}</td>
                <td class="px-6 py-4">{{ $anggota->ukm->nama_ukm }}</td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('anggota.edit',$anggota->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <span class="mx-2 text-gray-400">|</span>
                    <form action="{{ route('anggota.delete', $anggota->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data Anggota {{ $ukm->nama_ukm }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
