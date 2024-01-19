@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/obat" method="post">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">Obat</h5><br>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" value="{{ old('nama_obat') }}" autofocus placeholder="Nama Barang">
                            @error('nama_obat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Obat</label>
                        <select name="jenis_obat" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Obat Lunak">Obat Lunak</option>
                            <option value="Obat Keras">Obat Keras</option>
                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Merek Obat</label>
                            <input type="text" name="merek_obat" class="form-control @error('merek_obat') is-invalid @enderror" id="merek_obat" value="{{ old('merek_obat') }}" autofocus placeholder="Merek Obat">
                            @error('merek_obat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">masa Berlaku</label>
                            <input type="date" name="masa_berlaku" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" value="{{ old('masa_berlaku') }}" autofocus placeholder="masa_berlaku Barang">
                            @error('masa_berlaku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Stock</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" value="{{ old('stock') }}" autofocus placeholder="stock Barang">
                            @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                       <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                        <select name="satuan" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Strip">Strip</option>
                        </select>
                    </div>

                         <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Harga per Tablet</label>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" value="{{ old('harga') }}" autofocus placeholder="harga Barang">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/obat" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
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