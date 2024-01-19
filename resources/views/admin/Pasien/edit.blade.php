@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/pasien/{{ $pasien->id }}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit pasien
            </h3></b></div>
            <div class="card-body">
                      <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">NIK</label>
                            <input type="Number" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('pasien',$pasien->nik )}}" autofocus placeholder="Nik">
                            @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror" id="nama_pasien"value="{{ old('pasien',$pasien->nama_pasien )}}" autofocus placeholder="Nama Pasien">
                            @error('nama_pasien')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal Lahir</label>
                            <input type="date" name="tgl" class="form-control @error('tgl') is-invalid @enderror" id="tgl" value="{{ old('tgl') }}" autofocus placeholder="tgl">
                            @error('tgl')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" value="{{ old('pasien',$pasien->alamat)}}" autofocus placeholder="Alamat">
                            @error('Alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Laki-Laki">L</option>
                            <option value="Perempuan">P</option>
                        </select>
                    </div>
                        


                        <a href="/pasien" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection
