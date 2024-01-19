@extends('admin.layouts.main')

@section('container')

<div class="card">
    <h5 class="card-header">Pemasukan</h5>
    <div class="card-body">
        <form action ="/pengeluaran" method="post">
            @csrf

            <div class="card">
                    <h5 class="card-header text-center">Pemasukan</h5><br>
                    <div class="card-body">
                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kode Pemasukan</label>
                            <input type="text" class="form-control @error('kode_pengeluaran') is-invalid @enderror" id="kode_pengeluaran" name="kode_pengeluaran" value="{{old('kode_pengeluaran','KP-'.$kd)}}" readonly >
                            @error('kode_pengeluaran')
                                <div class="invalid-feedback">
                            {{ $message }}
                    </div>
                             @enderror
                </div>  

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
                                    <option value="{{ $obat->id }}">{{ $obat->merek_obat }}</option>  
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
       
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{old('keterangan')}}"  autofocus>
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>   

        <div class="modal-footer">
    <a href="/pengeluaran" class="btn btn-outline-secondary col-md-3 offset-md-6">Kembali</a>
    <button type="submit" name="submit" class="btn btn-primary col-md-3">Tambah Data</button>
</div>
        </form>
    </div>
</div>

</div><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection