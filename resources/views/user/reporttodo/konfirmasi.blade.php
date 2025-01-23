@extends('user.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Report To Do</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Report To Do</li>
        </ol>
    </nav>
</div>
<div class="text-center mb-3">
    <h2>Konfirmasi Delete Report To Do</h2>
</div>

<div class="container">
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center">
                <td>{{ $report->nama }}</td>
                <td>{{ $report->reporttodo_title }}</td>
                <td>{{ $report->reporttodo_description }}</td>
                <td>{{ $report->reporttodo_status }}</td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="{{ route('user.reporttodo.list') }}" class="btn btn-secondary btn-sm">Batal</a>
        <form method="POST" action="{{ route('user.reporttodo.destroy', $report->reporttodo_uuid) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </form>
    </div>
</div>
@endsection