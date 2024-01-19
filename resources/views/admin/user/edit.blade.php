@extends('admin.layouts.main')

@section('container')
<div class="row justify-content-center p-5">
    <div class="col-lg-6">
        {{-- @php
            dd($user->id);
        @endphp --}}
        <form method="post" action="/user/{{ $user->id }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card border-dark mb-3">
                <div class="card-header text-center">
                    <h3>Edit user</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama User</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('user', $user->name) }}" autofocus placeholder="Nama User">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('user', $user->email) }}" autofocus placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="gambar_user" class="form-label">Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('gambar_user') is-invalid @enderror" id="gambar_user" name="gambar_user" accept="image/*">
                                <label class="custom-file-label" for="gambar_user"></label>
                            </div>
                        </div>
                        @error('gambar_user')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($user->gambar_user)
                        <div class="mb-3">
                            <label for="gambar_user" class="form-label">Gambar saat ini:</label>
                            <img src="{{ asset('img/'.$user->gambar_user) }}" alt="Gambar User">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ old('user', $user->no_hp) }}" autofocus placeholder="No HP">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" name="posisi" class="form-control @error('posisi') is-invalid @enderror" id="posisi" value="{{ old('posisi') }}" autofocus placeholder="Posisi">
                        @error('posisi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                   <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
        <option value="">- Pilih Role -</option>
        <option value="dokter" {{ old('role') === 'dokter' ? 'selected' : '' }}>Dokter</option>
        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
        <option value="superadmin" {{ old('role') === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
    </select>
    @error('role')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


                    <a href="/user" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                    <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
