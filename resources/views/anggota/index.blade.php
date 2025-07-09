@extends('layout.main')

@section('title','Data Anggota')
@section('navAnggota','active')

@section('content')
<h1 class="h4 fw-bold mb-3">
    Anggota
    @if ($ukm)
        - {{ $ukm->nama_ukm }}
    @endif
</h1>

<a href="{{ route('anggota.create', ['ukm_id' => $ukm->id]) }}" class="btn btn-primary mb-3">
    + {{ $ukm->nama_ukm }}
</a>

@if($ukm && $anggotas->count())
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white shadow-sm rounded">
            <thead class="table-primary text-center text-uppercase">
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>UKM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotas as $anggota)
                <tr>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->nim }}</td>
                    <td>{{ $anggota->email }}</td>
                    <td>{{ $anggota->ukm->nama_ukm }}</td>
                    <td class="text-center">
                        <a href="{{ route('anggota.edit',$anggota->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('anggota.delete', $anggota->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@elseif($ukm)
    <div class="text-muted mt-3">Belum ada anggota untuk UKM ini.</div>
@endif

{{-- Tampilan jika tidak ada anggota (global check, tidak berdasarkan ukm_id) --}}
@if(!$anggotas->count())
    <div class="text-center text-muted mt-4">Belum ada data Anggota {{ $ukm->nama_ukm }}</div>
@endif
@endsection
