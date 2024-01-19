@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/pemeriksaan/{{ $pemeriksaan->id}}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit pemeriksaan
            </h3></b></div>
            <div class="card-body">
                      <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kode Pemeriksaan</label>
                            <input type="text" class="form-control @error('kode_pemeriksaan') is-invalid @enderror" id="kode_pemeriksaan" name="kode_pemeriksaan" value="{{ old('pemeriksaan',$pemeriksaan->kode_pemeriksaan)}}" readonly >
                            @error('kode_pemeriksaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                         </div>
                         
                           <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('pemeriksaan',$pemeriksaan->tanggal)}}" autofocus placeholder="tekanan darah">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">tekanan darah</label>
                            <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" value="{{ old('pemeriksaan',$pemeriksaan->tekanan_darah)}}" autofocus placeholder="tekanan darah">
                            @error('tekanan_darah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                       <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Suhu Badan</label>
                            <input type="text" name="suhu_badan" class="form-control @error('suhu_badan') is-invalid @enderror" id="suhu_badan" value="{{ old('pemeriksaan',$pemeriksaan->suhu_badan)}}" autofocus placeholder="suhu badan">
                            @error('suhu_badan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Keluhan</label>
                            <input type="text" name="keluhan" class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" value="{{ old('pemeriksaan',$pemeriksaan->keluhan)}}" autofocus placeholder="suhu badan">
                            @error('keluhan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="/pemeriksaan" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection
