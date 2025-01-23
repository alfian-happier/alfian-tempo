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
    <h2>Edit Pengguna</h2>
</div>
<div class="container">
    <form action="{{ route('administrator.pengguna.update', $user->uuid) }}" method="post" enctype="multipart/form-data">
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
            <input type="text" class="form-control" name="email" id="email" autocomplete="off" value="{{ old('email', $user->email) }}">
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="role"><b>Role</b></label>
            <select class="form-control" name="role" id="role">
                @php
                $roles = ['Administrator'];
                $userRole = $user->role;
                @endphp
                <option value="{{ $userRole }}">{{ $userRole }}</option>
                @foreach($roles as $role)
                @if($role != $userRole)
                <option value="{{ $role }}">{{ $role }}</option>
                @endif
                @endforeach
            </select>
            @error('role')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="password"><b>password</b></label>
            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
            <p class="text-muted">Kosongkan password apabila tidak ingin diganti.</p>
            @error('password')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <a href="{{ route('administrator.pengguna.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
            <button id="editPenggunaBtn" class="btn btn-sm btn-primary">Edit Pengguna</button>
        </div>
    </form>
</div>
@endsection