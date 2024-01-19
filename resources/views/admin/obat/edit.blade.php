@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/obat/{{ $obats->id }}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit obat
            </h3></b></div>
            <div class="card-body">
                      <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" value="{{ old('obat',$obats->nama_obat )}}" autofocus placeholder="Nama Barang">
                            @error('nama_obat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Obat</label>
                        <select name="jenis_obat" class="form-control">
                            <option value="{{ old('obat',$obats->jenis_obat )}}">- Pilih -</option>
                            <option value="Obat Lunak">Obat Lunak</option>
                            <option value="Obat Keras">Obat Keras</option>
                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Merek Obat</label>
                            <input type="text" name="merek_obat" class="form-control @error('merek_obat') is-invalid @enderror" id="merek_obat" value="{{ old('obat',$obats->merek_obat )}}" autofocus placeholder="Merek Obat">
                            @error('merek_obat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">masa Berlaku</label>
                            <input type="date" name="masa_berlaku" class="form-control @error('masa_berlaku') is-invalid @enderror" id="masa_berlaku" value="{{ old('obat',$obats->masa_berlaku )}}" autofocus placeholder="masa_berlaku Barang">
                            @error('masa_berlaku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Stock</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" value="{{ old('obat',$obats->stock )}}" autofocus placeholder="stock Barang">
                            @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                        <select name="satuan" class="form-control">
                            <option value="{{ old('obat',$obats->Satuan )}}">- Pilih -</option>
                            <option value="Obat Lunak">Strip</option>
                        </select>
                    </div>

                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Harga Per Tablet</label>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" value="{{ old('obat',$obats->harga )}}" autofocus placeholder="harga Barang">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="/obat" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection
