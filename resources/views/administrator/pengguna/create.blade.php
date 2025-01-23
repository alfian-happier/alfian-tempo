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

<div class="text-center mb2">
    <h2>Tambah Pengguna</h2>
</div>

<form action="{{ route('administrator.pengguna.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-3">
        <label for="nama"><b>Nama</b></label>
        <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" placeholder="Masukan Nama .." value="{{ old('nama') }}">
        @error('nama')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="email"><b>Email</b></label>
        <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Masukan Email .." value="{{ old('email') }}">
        @error('email')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="password"><b>Password</b></label>
        <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Masukan Password ..">
        @error('password')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="role"><b>Pengguna Role</b></label>
        <select id="role" name="role" class="form-control">
            <option value="">- Pilih Role -</option>
            <option value="Administrator" {{ old('role') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
            <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
        </select>
        @error('role')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <a href="{{ route('administrator.pengguna.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
        <button id="tambahPenggunaBtn" class="btn btn-sm btn-primary">Tambah Pengguna</button>
    </div>
</form>
@endsection