@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/peralatan_medis" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">peralatan Medis</h5><br>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Kode alat</label>
                            <input type="text" name="kode_alat" class="form-control @error('kode_alat') is-invalid @enderror" id="kode_alat" value="{{ old('kode_alat') }}" autofocus placeholder="Nama Barang">
                            @error('kode_alat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama alat</label>
                            <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" id="nama_alat" value="{{ old('nama_alat') }}" autofocus placeholder="Nama Barang">
                            @error('nama_alat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="gambar_alat" class="form-label">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('gambar_alat') is-invalid @enderror"
                                        id="gambar_alat" name="gambar_alat" accept="img/*">
                                    <label class="custom-file-label" for="gambar_alat"></label>
                                </div>
                            </div>
                            @error('gambar_alat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Jumlah alat</label>
                            <input type="number" name="jumlah_alat" class="form-control @error('jumlah_alat') is-invalid @enderror" id="jumlah_alat" value="{{ old('jumlah_alat') }}" autofocus placeholder="Nama Barang">
                            @error('jumlah_alat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">keterangan</label>
                            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{ old('keterangan') }}" autofocus placeholder="Keterangan">
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/peralatan_medis" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
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