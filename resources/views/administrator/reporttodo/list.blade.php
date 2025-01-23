@extends('administrator.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>Report To Do</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Report To Do</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar Report To Do</h2>
</div>

<div class="box-header d-flex justify-content-end mb-3">
    <div class="btn-group">
        <a href="{{ route('administrator.reporttodo.create') }}" class="btn btn-secondary">
            <i class="bi bi-plus"></i>&nbsp;Tambah Data Report To Do
        </a>
    </div>
</div>

<div class="container">
    <div class="mb-2">
        <!-- Search -->
        <form action="{{ route('administrator.reporttodo.search') }}" method="GET" class="form-inline mt-3">
            <div class="input-group">
                <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if($reports->isEmpty())
    <div class="alert alert-info mt-3 text-center">Report To Do tidak ditemukan.</div>
    @else
    <table class="table">
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
                <td>{{ $index + 1 + ($reports->currentPage() - 1) * $reports->perPage() }}</td>
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

    <!-- Custom Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($reports->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $reports->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($reports->getUrlRange(1, $reports->lastPage()) as $page => $url)
            @if ($page == $reports->currentPage())
            <li class="page-item active">
                <a class="page-link" href="#">{{ $page }}</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($reports->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $reports->nextPageUrl() }}">Next</a>
            </li>
            @else
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
    @endif
</div>

@endsection