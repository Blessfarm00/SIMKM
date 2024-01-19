@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/sunat/{{ $sunat->id}}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit Tabel Sunat
            </h3></b></div>
            <div class="card-body">
            <div class="row">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="string" class="form-control @error('nama_pasien') is-invalid @enderror" id="nama_pasien" name="nama_pasien" value="{{ old('sunat',$sunat->nama_pasien )}}"  autofocus>
                        @error('nama_pasien')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            
            <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('sunat',$sunat->alamat )}}"  autofocus>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>  
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Pilih Perawat</label>
                <select class="form-control @error('dokter_id') is-invalid @enderror" id="dokter_id" name="dokter_id" autofocus>
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokterList as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id', $sunat->dokter_id) == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama_dokter }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>  

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">umur</label>
                    <input type="text" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ old('sunat',$sunat->umur )}}"  autofocus>
                    @error('umur')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>  

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">tanggal</label>
                    <input type="text" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('sunat',$sunat->tanggal )}}"  autofocus>
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>  


                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('sunat',$sunat->keterangan )}}"  autofocus>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>   
            </div>
                        <a href="/resep-obat" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection


