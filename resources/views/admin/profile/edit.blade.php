@extends('admin.layouts.main')

@section('container')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <div class="user-card">
                            <h2>{{ $user->name ?? $user->nama_dokter }}</h2>
                            <img src="{{ asset('img/' . ($user->gambar_user ?? $user->gambar_dokter)) }}" alt="User Image"
                                class="rounded-pill">
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
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                {{-- @php
                    dd($user);
                @endphp --}}
                                <h5 class="card-title">Profile Details</h5>
                                <form action="/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">Nama User</div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" name="name"
                                                value="{{ $user->name ?? $user->nama_dokter }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="email" name="email" value="{{ $user->email ?? $user->email }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">No Handphone</div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" name="no_hp" value="{{ $user->no_hp ?? $user->no_hp }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">Posisi</div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" name="posisi" value="{{ $user->posisi }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" name="role" value="{{ $user->role ?? $user->role }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        
                                        @error('gambar_user')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label">Password Sebelumnya</div>
                                            <div class="col-lg-9 col-md-8">

                                                <input type="password" name="current_password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    class="form-control">
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label">Password baru</div>
                                            <div class="col-lg-9 col-md-8">
                                                <input type="password" name="new_password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    class="form-control">
                                                @error('new_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label">Konfirmasi Password</div>
                                            <div class="col-lg-9 col-md-8">
                                                <input type="password" name="confirm_password"
                                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                                    class="form-control">
                                                @error('confirm_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <label for="gambar_user" class="form-label">Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('gambar_user') is-invalid @enderror"
                                                    id="gambar_user" name="gambar_user" accept="image/*">
                                                <label class="custom-file-label" for="gambar_user"></label>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark">Update Profile</button>
                                        </div>
                                        
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
