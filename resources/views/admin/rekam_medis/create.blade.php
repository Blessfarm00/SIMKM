@extends('admin.layouts.main')

@section('container')

<div class="card">
    <h5 class="card-header">Rekam Medis</h5>
    <div class="card-body">
        <form action ="/rekam-medis" method="post">
            @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kode Rekam Medis</label>
                    <input type="text" class="form-control @error('kode_rekam_medis') is-invalid @enderror" id="kode_rekam_medis" name="kode_rekam_medis" value="{{old('kode_rekam_medis','KRM-'.$kd)}}" readonly  autofocus>
                    @error('kode_rekam_medis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Kode Pemeriksaan</label>
                        <select class="form-select" name="pemeriksaan_id" aria-label="Default select   example">
                            <option selected></option>
                            @foreach($pemeriksaans as $pemeriksaan)
                                @if (old('jurusan_id') == $pemeriksaan->id)
                                    <option value="{{ $pemeriksaan->id }}" selected>{{ $pemeriksaan->kode_pemeriksaan }} - {{ $pemeriksaan->pasien_id }}</option>
                                @else
                                    <option value="{{ $pemeriksaan->id }}">{{ $pemeriksaan->kode_pemeriksaan }}</option>  
                                @endif
                                
                            @endforeach

                        </select>
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
                    <label for="exampleFormControlInput1" class="form-label">Diagnosa</label>
                    <input type="text" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" name="diagnosa" value="{{old('diagnosa')}}"  autofocus>
                    @error('diagnosa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
       


                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tindakan</label>
                    <input type="text" class="form-control @error('tindakan') is-invalid @enderror" id="tindakan" name="tindakan" value="{{old('tindakan')}}"  autofocus>
                    @error('tindakan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
          

           
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Rujukan</label>
                    <input type="text" class="form-control @error('rujukan') is-invalid @enderror" id="rujukan" name="rujukan" value="{{old('rujukan')}}"  autofocus>
                    @error('rujukan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>   
            </div>
        
        <div class="modal-footer">
            <a href="/rekam_medis" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
            <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
        </div>

</div>
        </form>
    </div>
</div>


@endsection
