@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/dokter" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">Perawat</h5><br>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Perawat</label>
                            <input type="text" name="nama_dokter" class="form-control @error('nama_dokter') is-invalid @enderror" id="nama_dokter" value="{{ old('nama_dokter') }}" autofocus placeholder="Nama Barang">
                            @error('nama_dokter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gambar_dokter" class="form-label">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('gambar_dokter') is-invalid @enderror"
                                        id="gambar_dokter" name="gambar_dokter" accept="img/*">
                                    <label class="custom-file-label" for="gambar_dokter"></label>
                                </div>
                            </div>
                            @error('gambar_dokter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jensis kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Laki-laki">L</option>
                            <option value="Perempuan">p</option>
                        </select>
                    </div>  
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Umur</label>
                            <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" id="umur" value="{{ old('umur') }}" autofocus placeholder="Umur">
                            @error('umur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">No HP</label>
                            <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ old('no_hp') }}" autofocus placeholder="no_hp">
                            @error('no_hp')
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
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Role</label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" id="role" value="Dokter">
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
                            <a href="/dokter" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>

                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br>


@endsection