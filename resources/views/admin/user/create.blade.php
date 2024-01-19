@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">user</h5><br>
                    <div class="card-body">
                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama User</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                             @enderror
                         </div>  
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" autofocus placeholder="email">
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
                                    <input type="file" class="custom-file-input @error('gambar_user') is-invalid @enderror"
                                        id="gambar_user" name="gambar_user" accept="img/*">
                                    <label class="custom-file-label" for="gambar_user"></label>
                                </div>
                            </div>
                            @error('gambar_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">NO HP</label>
                            <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ old('no_hp') }}" autofocus placeholder="NO HP">
                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Posisi</label>
                            <input type="text" name="posisi" class="form-control @error('posisi') is-invalid @enderror" id="posisi" value="{{ old('posisi') }}" autofocus placeholder="Posisi">
                            @error('posisi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Role</label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" id="role" value="{{ old('role') }}" autofocus placeholder="Role">
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" autofocus placeholder="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/user" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
                            <button name="submit" class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br>


@endsection