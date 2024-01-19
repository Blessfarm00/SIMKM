@extends('admin.layouts.main')

@section('container')

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <div class="user-card">
<h2>{{ $user->name ?? $user->nama_dokter }}</h2>
<img src="{{ asset('img/' . ($user->gambar_user ?? $user->gambar_dokter)) }}" alt="User Image" class="rounded-pill">

                            <!-- Tampilkan properti pengguna lainnya -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profile Details</h5>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama User</div>
                                <div class="col-lg-9 col-md-8">{{ $user->name ?? $user ->nama_dokter }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">No Handphone</div>
                                <div class="col-lg-9 col-md-8">{{ $user->no_hp }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Posisi</div>
                                <div class="col-lg-9 col-md-8">{{ $user->posisi }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Role</div>
                                <div class="col-lg-9 col-md-8">{{ $user->role }}</div>
                            </div>
                            <div class="text-center">
                                <a href="/profile/{{ $user->id }}/edit" class="btn btn-primary"><i class="fas fa-pen-to-square text"  ></i> Edit</a>
                                <form action="/profile/{{ $user->id }}" method="post" class="d-inline">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('sweetalert::alert')
@endsection
