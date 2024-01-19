@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/pengambilan/{{ $pengambilan->id}}">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit Pengambilan
            </h3></b></div>
            <div class="card-body">
                      <div class="row">
                <div class="col-md-6">  
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Obat</label>
                        <select class="form-select" name="obat_id"   aria-label="Default select example">
                            <option selected></option>
                            @foreach($obats as $obat)
                                @if (old('obat_id') == $obat->id)
                                    <option value="{{ $obat->id }}" selected>{{ $obat->nama_obat }}</option>
                                @else
                                    <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>  
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah Obat</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('pengambilan', $pengambilan->jumlah) }}" autofocus>
                    @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        </div>
            <a href="/pengambilan" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
            <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
        </div>
                </div>
            </div>
        

    </form>
    </div>  

@endsection
