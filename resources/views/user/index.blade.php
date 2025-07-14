@extends('layout.main')
@section('title', 'Manajemen User')
@section('navUser', 'active')

@section('content')
<div class="card">
    @can('create-user')
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar User</h5>
      <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">+ Tambah User</a>
    </div>
    @endcan

  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Level</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $i => $user)
        @can('role-user', $user)


        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role ?? '-' }}</td>
          <td>
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
            @can('create-user')
            <form action="{{ route('user.delete', $user->id) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Yakin hapus user ini?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>

            @endcan
          </td>
        </tr>
        @endcan
        @endforeach
        @if($users->isEmpty())
        <tr><td colspan="5" class="text-center text-muted">Belum ada user terdaftar.</td></tr>
        @endif
      </tbody>
    </table>
  </div>

</div>
@endsection
