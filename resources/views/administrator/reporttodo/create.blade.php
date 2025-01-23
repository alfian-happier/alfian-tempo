@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Report To Do</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Report To Do</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Tambah Report To Do</h2>
</div>

<form action="{{ route('administrator.reporttodo.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-3">
        <label for="title"><b>Title</b></label>
        <input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Masukan Title .." value="{{ old('title') }}">
        @error('title')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="description"><b>Description</b></label>
        <textarea class="form-control" name="description" id="description" autocomplete="off" placeholder="Masukan Description ..">{{ old('description') }}</textarea>
        @error('description')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="status"><b>Status</b></label>
        <select id="status" name="status" class="form-control">
            <option value="">- Pilih Status -</option>
            <option value="Pending">Pending</option>
        </select>
        @error('status')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <a href="{{ route('administrator.reporttodo.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
        <button id="tambahReport To DoBtn" class="btn btn-sm btn-primary">Tambah Report To Do</button>
    </div>
</form>
@endsection