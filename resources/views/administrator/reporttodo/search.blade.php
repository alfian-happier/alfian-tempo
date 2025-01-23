@extends('administrator.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian Report To Do</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('administrator.reporttodo.search') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;" value="{{ old('query', $search) }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('administrator.reporttodo.list') }}">
                    <button type="button" class="btn btn-danger">Kembali</button>
                </a>
            </div>
        </div>
    </form>

    @if(isset($reports))
    @if($reports->isEmpty())
    <div class="alert alert-danger mt-3 text-center">Report To Do tidak ditemukan.</div>
    @else
    <table class="table mt-3">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $index => $report)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $report->nama }}</td>
                <td>{{ $report->reporttodo_title }}</td>
                <td>{{ $report->reporttodo_description }}</td>
                <td>{{ $report->reporttodo_status }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('administrator.reporttodo.edit', $report->reporttodo_uuid) }}" class="btn btn-secondary btn-sm mr-1">Edit</a>
                        <a href="{{ route('administrator.reporttodo.konfirmasi', $report->reporttodo_uuid) }}" class="btn btn-danger btn-sm">Hapus</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @endif
</div>

@endsection