

@extends('admin.layouts.main')

@section('container')

@if (session()->has('messageLogin'))
<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    {{ session('messageLogin') }}
    <button type=" button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-4">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="/obat">Obat</a> <span></span></h5>
                     <p>{{ $jumlahObats }} Jenis</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="/janji">Janji</a> <span>| Bulan Ini</span></h5>
                     <p>{{ $totalJanji }}</p>
                </div>
                
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title"><a href="/pendapatan">Pendapatan</a> <span>| Bulan ini</span></h5>
                    <p>{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
