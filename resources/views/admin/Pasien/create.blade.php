@extends('admin.layouts.main')

@section('container')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <form action="/pasien" method="post">
                @csrf
                <div class="card">
                    <h5 class="card-header text-center">Pasien</h5><br>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">NIK</label>
                            <input type="Number" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik') }}" autofocus placeholder="Nik">
                            @error('nik')
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
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Tanggal Lahir</label>
                            <input type="date" name="tgl" class="form-control @error('tgl') is-invalid @enderror" id="tgl" value="{{ old('tgl') }}" autofocus placeholder="tgl">
                            @error('tgl')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" value="{{ old('Alamat') }}" autofocus placeholder="Alamat">
                            @error('Alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Laki Laki">L</option>
                            <option value="Perempuan">P</option>
                        </select>
                    </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/pasien" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
                            <button name="submit" class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <script>
    document.getElementById('tgl_lahir').addEventListener('change', function() {
        var tgl_lahir = new Date(this.value);
        var today = new Date();
        var age = today.getFullYear() - tgl_lahir.getFullYear();

        if (today.getMonth() < tgl_lahir.getMonth() ||
            (today.getMonth() === tgl_lahir.getMonth() && today.getDate() < tgl_lahir.getDate())) {
            age--;
        }

        document.getElementById('umur_pasien').value = age;
    });
</script>
</div><br><br><br><br><br><br><br><br><br><br><br><br>


@endsection