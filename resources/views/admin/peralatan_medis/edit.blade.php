@extends('admin.layouts.main')

@section('container')
    <div class="row justify-content-center p-5">
        <div class="col-lg-6">
            <form method="post" action="/peralatan_medis/{{ $peralatan_medis->id }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card border-dark mb-3">
                    <div class="card-header text-center">
                        <h3><b>Edit Alat Medis</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama_alat" class="form-label" style="text-align: center;">Nama Alat</label>
                            <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" id="nama_alat" value="{{ old('peralatan_medis', $peralatan_medis->nama_alat) }}" autofocus placeholder="Nama Alat">
                            @error('nama_alat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                           <div class="mb-3">
                        <label for="gambar_alat" class="form-label">Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('gambar_alat') is-invalid @enderror" id="gambar_alat" name="gambar_alat" accept="image/*">
                                <label class="custom-file-label" for="gambar_alat"></label>
                            </div>
                        </div>
                        @error('gambar_alat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($peralatan_medis->gambar_alat)
                        <div class="mb-3">
                            <label for="gambar_alat" class="form-label">Gambar saat ini:</label>
                            <img src="{{ asset('img/'.$peralatan_medis->gambar_alat) }}" alt="Gambar peralatan_medis ">
                        </div>
                    @endif
            

                        

                        <div class="mb-3">
                            <label for="jumlah_alat" class="form-label" style="text-align: center;">Jumlah Alat</label>
                            <input type="number" name="jumlah_alat" class="form-control @error('jumlah_alat') is-invalid @enderror" id="jumlah_alat" value="{{ old('peralatan_medis', $peralatan_medis->jumlah_alat) }}" autofocus placeholder="Jumlah Alat">
                            @error('jumlah_alat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label" style="text-align: center;">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{ old('peralatan_medis', $peralatan_medis->keterangan) }}" autofocus placeholder="Keterangan">
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <a href="/peralatan_medis" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
