@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div>
<div class="text-center mb-3">
    <h2>Konfirmasi Delete Pengguna</h2>
</div>

<div class="container">
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center">
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="{{ route('administrator.pengguna.list') }}" class="btn btn-secondary btn-sm">Batal</a>
        <form method="POST" action="{{ route('administrator.pengguna.destroy', $user->uuid) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </form>
    </div>
</div>

@endsection