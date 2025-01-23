@extends('administrator.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar Pengguna</h2>
</div>

<div class="box-header d-flex justify-content-end mb-3">
    <div class="btn-group">
        <a href="{{ route('administrator.pengguna.create') }}" class="btn btn-secondary">
            <i class="bi bi-plus"></i>&nbsp;Tambah Data Pengguna
        </a>
    </div>
</div>

<div class="container">
    <div class="mb-2">
        <!-- Search -->
        <form action="{{ route('administrator.pengguna.search') }}" method="GET" class="form-inline mt-3">
            <div class="input-group">
                <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if($users->isEmpty())
    <div class="alert alert-info mt-3 text-center">Pengguna tidak ditemukan.</div>
    @else
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Sebagai</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr class="text-center">
                <td>{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if($user->uuid !== Auth::user()->uuid && $user->role !== 'Administrator')
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('administrator.pengguna.edit', $user->uuid) }}" class="btn btn-secondary btn-sm mr-1">Edit</a>
                    </div>
                    <form method="GET" action="{{ route('administrator.pengguna.konfirmasi', $user->uuid) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Custom Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($users->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            @if ($page == $users->currentPage())
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
            @if ($users->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
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