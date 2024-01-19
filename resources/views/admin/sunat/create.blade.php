@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/sunat" method="post">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">Sunat</h5><br>
                    <div class="card-body">

                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kode sunat</label>
                            <input type="text" class="form-control @error('kode_sunat') is-invalid @enderror" id="kode_sunat" name="kode_sunat" value="{{old('kode_sunat','KS-'.$kd)}}" readonly >
                            @error('kode_sunat')
                                <div class="invalid-feedback">
                            {{ $message }}
                    </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror" id="nama_pasien" value="{{ old('nama_pasien') }}" autofocus placeholder="Nama Pasien">
                            @error('nama_pasien')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                            
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat') }}" autofocus placeholder="Nama Pasien">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                       <div class="mb-3">
                                <label for="jurusan" class="form-label">Perawat</label>
                                    <select class="form-select" name="dokter_id" aria-label="Default select example">
                                        <option selected></option>
                                        @foreach($dokters as $dokter)
                                            @if (old('dokter_id') == $dokter->id)
                                                <option value="{{ $dokter->id }}" selected>{{ $dokter->nama_dokter }}</option>
                                            @else
                                                <option value="{{ $dokter->id }}">{{ $dokter->nama_dokter }}</option>  
                                            @endif

                                        @endforeach
                                    </select>
                            </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Umur</label>
                            <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" id="keterangan" value="{{ old('umur') }}" autofocus placeholder="Umur">
                            @error('umur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="keterangan" value="{{ old('tanggal') }}" autofocus placeholder="tanggal">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                          <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Metode</label>
                        <select name="keterangan" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Laser">Laser</option>
                            <option value="Klamp">Klamp</option>
                            <option value="Gunting">Gunting</option>
                        </select>
                    </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/sunat" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
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