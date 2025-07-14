@extends('layout.main')
@section('title', 'Data UKM')
@section('navUkm', 'active') {{-- Optional: ubah jika ingin tanda aktif --}}

@section('content')
<h1 class="text-center fw-bold fs-3 mb-4">Daftar UKM</h1>
@can('create-ukm')

<a href="{{ route('ukm.create') }}" class="btn btn-primary mb-3">
    + Tambah Data UKM
</a>
@endcan

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle bg-white shadow-sm rounded">
        <thead class="table-primary">
            <tr class="text-nowrap text-center">
                <th>Nama UKM</th>
                <th>Ketua Umum</th>
                <th>Tahun Berdiri</th>
                <th>Deskripsi</th>
                <th>Logo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ukms as $ukm)
            @can('access',$ukm->id)
                <tr>
                    <td>{{ $ukm->nama_ukm }}</td>
                    <td>{{ $ukm->ketum }}</td>
                    <td>{{ $ukm->thn_berdiri }}</td>
                    <td class="text-truncate" style="max-width: 250px;" title="{{ $ukm->deskripsi }}">
                        {{ Str::limit($ukm->deskripsi, 50) }}
                    </td>
                    <td class="text-center">
                        @if($ukm->logo_ukm)
                            <img src="{{ asset('storage/' . $ukm->logo_ukm) }}"
                                alt="Logo {{ $ukm->nama_ukm }}"
                                class="img-thumbnail" style="height: 48px; width: 48px; object-fit: contain;">
                        @else
                            <span class="text-muted fst-italic">Tidak ada logo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('ukm.edit', $ukm->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        @can('create-ukm')

                        <form action="{{ route('ukm.delete', $ukm->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                 @endcan
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data UKM.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
