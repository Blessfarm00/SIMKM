@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/perawatan" method="post">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">Perawatan Luka</h5><br>
                    <div class="card-body">

                       <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kode perawatan</label>
                            <input type="text" class="form-control @error('kode_perawatan') is-invalid @enderror" id="kode_perawatan" name="kode_perawatan" value="{{old('kode_perawatan','KPL-'.$kd)}}" readonly >
                            @error('kode_perawatan')
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
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Jenis Luka</label>
                            <input type="text" name="jenis_luka" class="form-control @error('jenis_luka') is-invalid @enderror" id="status" value="{{ old('jenis_luka') }}" autofocus placeholder="Jenis Luka">
                            @error('jenis_luka')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Status</label>
    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
        <option value="">- Pilih -</option>
        <option value="<50%" {{ old('status') === '<50%' ? 'selected' : '' }}> <50% </option>
        <option value=">50%" {{ old('status') === '>50%' ? 'selected' : '' }}> >50% </option>
        <option value="100%" {{ old('status') === '100%' ? 'selected' : '' }}> 100% </option>
    </select>
    @error('status')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<!-- Pengerjaan -->
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Pengerjaan</label>
    <input type="text" name="pengerjaan" class="form-control" id="pengerjaan" readonly>
</div>

<script>
document.getElementById('status').addEventListener('change', function() {
    var selectedValue = this.value;
    var pengerjaanInput = document.getElementById('pengerjaan');

    if (selectedValue === '100%') {
        pengerjaanInput.value = 'Selesai';
    } else {
        pengerjaanInput.value = 'Proses';
    }
});
</script>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/perawatan" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
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