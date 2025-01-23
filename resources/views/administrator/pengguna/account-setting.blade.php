@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Profil Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </nav>
</div>

<div class="container">
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif
    <div class="text-center mb-2">
        <h2>Profil</h2>
    </div>

    <form action="{{ route('administrator.pengguna.updateProfil', $user->uuid) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="nama"><b>Nama</b></label>
            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="{{ old('nama', $user->nama) }}">
            @error('nama')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="{{ old('email', $user->email) }}">
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
            <p class="text-muted">Kosongkan password apabila tidak ingin diganti.</p>
            @error('password')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button id="editPenggunaBtn" class="btn btn-sm btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection