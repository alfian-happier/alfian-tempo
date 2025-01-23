@extends('user.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Edit Report To Do</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit Report To Do</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Edit Report To Do</h2>
</div>
<div class="container">
    <form action="{{ route('user.reporttodo.update', $report->reporttodo_uuid) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="title"><b>Title</b></label>
            <input type="text" class="form-control" name="title" id="title" autocomplete="off" value="{{ old('title', $report->reporttodo_title) }}">
            @error('title')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="description"><b>Description</b></label>
            <textarea class="form-control" name="description" id="description" autocomplete="off">{{ old('description', $report->reporttodo_description) }}</textarea>
            @error('description')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="status"><b>Status</b></label>
            <select id="status" name="status" class="form-control">
                <option value="Pending" {{ old('status', $report->reporttodo_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="InProgress" {{ old('status', $report->reporttodo_status) == 'InProgress' ? 'selected' : '' }}>InProgress</option>
                <option value="Completed" {{ old('status', $report->reporttodo_status) == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <a href="{{ route('user.reporttodo.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
            <button id="editReportToDoBtn" class="btn btn-sm btn-primary">Edit Report To Do</button>
        </div>
    </form>
</div>
@endsection