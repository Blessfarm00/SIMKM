@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/rekam_medis/{{ $rekam_medis->id }}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit rekam_medis
            </h3></b></div>
            <div class="card-body">
                      <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Kode Rekam Medis</label>
                            <input type="text" name="kode_rekam_medis" class="form-control @error('kode_rekam_medis') is-invalid @enderror" id="kode_rekam_medis" value="{{ old('rekam_medis',$rekam_medis->kode_rekam_medis )}}" readonly autofocus placeholder="Nama Barang">
                            @error('kode_rekam_medis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Diagnosa</label>
                            <input type="text" name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" value="{{ old('rekam_medis',$rekam_medis->diagnosa )}}" autofocus placeholder="Merek rekam_medis">
                            @error('diagnosa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tindakan</label>
                            <input type="text" name="tindakan" class="form-control @error('tindakan') is-invalid @enderror" id="tindakan" value="{{ old('rekam_medis',$rekam_medis->tindakan )}}" autofocus placeholder="tindakan Barang">
                            @error('tindakan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Rujukan</label>
                            <input type="text" name="rujukan" class="form-control @error('rujukan') is-invalid @enderror" id="rujukan" value="{{ old('rekam_medis',$rekam_medis->rujukan )}}" autofocus placeholder="rujukan Barang">
                            @error('rujukan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="/rekam-medis" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection
