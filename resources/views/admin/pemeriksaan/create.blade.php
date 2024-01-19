@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/pemeriksaan" method="post">
                @csrf
                <div class="card mt-4">
                    <h5 class="card-header text-center">Pemeriksaan</h5><br>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kode Pemeriksaan</label>
                            <input type="text" class="form-control @error('kode_pemeriksaan') is-invalid @enderror" id="kode_pemeriksaan" name="kode_pemeriksaan" value="{{ old('kode_pemeriksaan', 'KP-' . $kd) }}" readonly>
                            @error('kode_pemeriksaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>  

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('tanggal') }}" autofocus>
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Pasien</label>
                            <select class="form-select" name="pasien_id" aria-label="Default select example">
                                <option selected></option>
                                @foreach($pasiens->sortBy('nama_pasien') as $pasien)
                                    @if (old('pasien_id') == $pasien->id)
                                        <option value="{{ $pasien->id }}" selected>{{ $pasien->nama_pasien }} - {{ $pasien->nik }}</option>
                                    @else
                                        <option value="{{ $pasien->id }}">{{ $pasien->nama_pasien }} - {{ $pasien->nik }}</option>  
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Perawat</label>
                            <select class="form-select" name="dokter_id" aria-label="Default select example">
                                <option selected></option>
                                @foreach($dokters->sortBy('nama_dokter') as $dokter)
                                    @if (old('dokter_id') == $dokter->id)
                                        <option value="{{ $dokter->id }}" selected>{{ $dokter->nama_dokter }}</option>
                                    @else
                                        <option value="{{ $dokter->id }}">{{ $dokter->nama_dokter }}</option>  
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tekanan Darah</label>
                            <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" value="{{ old('tekanan_darah') }}" autofocus>
                            @error('tekanan_darah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Suhu Badan</label>
                            <input type="text" name="suhu_badan" class="form-control @error('suhu_badan') is-invalid @enderror" id="suhu_badan" value="{{ old('suhu_badan') }}" autofocus>
                            @error('suhu_badan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Keluhan</label>
                            <input type="text" name="keluhan" class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" value="{{ old('keluhan') }}" autofocus>
                            @error('keluhan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/pemeriksaan" class="btn btn-outline-danger col-md-3">Kembali</a>
                            <button name="submit" class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

@endsection
