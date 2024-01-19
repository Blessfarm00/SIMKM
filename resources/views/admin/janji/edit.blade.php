@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/janji/{{ $janji->id }}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit Janji
            </h3></b></div>
            <div class="card-body">
                      <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('janji',$janji->nama )}}" autofocus placeholder="nama" readonly>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat"value="{{ old('janji',$janji->alamat )}}" autofocus placeholder="Nama janji" readonly>
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('janji', $janji->tanggal) }}" autofocus placeholder="tanggal" readonly>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">No HP</label>
                            <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ old('janji',$janji->no_hp)}}" autofocus placeholder="no_hp" readonly>
                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Jam</label>
                            <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" id="jam" value="{{ old('janji',$janji->jam)}}" autofocus placeholder="jam" readonly>
                            @error('jam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Alasan Penolakan</label>
                            <input type="text" name="alasan_penolakan" class="form-control @error('alasan_penolakan') is-invalid @enderror" id="alasan_penolakan"value="{{ old('janji',$janji->alasan_penolakan )}}" autofocus placeholder="Nama janji">
                            @error('alasan_penolakan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                       
                        


                        <a href="/janji" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection
