@extends('admin.layouts.main')

@section('container')

<div class="card">
    <h5 class="card-header">Pengambilan</h5>
    <div class="card-body">
        <form action ="/pengambilan" method="post">
            @csrf

            <div class="card">
                    <h5 class="card-header text-center">Pengambilan</h5><br>


            <div class="row">
                <div class="col-md-6">  
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Obat</label>
                        <select class="form-select" name="obat_id" aria-label="Default select example">
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
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{old('jumlah')}}"  autofocus>
                    @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
            
        <div class="modal-footer">
    <a href="/pengambilan" class="btn btn-outline-secondary col-md-3 offset-md-6">Kembali</a>
    <button type="submit" name="submit" class="btn btn-primary col-md-3">Tambah Data</button>
</div>
        </form>
    </div>
</div>

</div><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection