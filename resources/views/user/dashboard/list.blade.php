@extends('user.layouts.template')

@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class=" breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Start Report To Do-->
        <div class="col-lg-4 col-md-6">
            <div class="custom-info-box">
                <div class="custom-info-body">
                    <i class="bi bi-bookmark"></i>
                    <div class="custom-info-content">
                        <h5 class="custom-info-title">Report To Do</h5>
                        <p class="custom-info-text"></p>
                        <a href="{{ route('user.reporttodo.list') }}"><button class="custom-btn-primary">Lihat</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Report To Do-->
</section>

@endsection