@extends('admin.layouts.main');
@section('container')

<div class=" row justify-content-center p-5" >
    <div class="col-lg-6">
    <form  method="post" action ="/dokter/{{ $dokter->id }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card border-dark mb-3" >
            <div class="card-header text-center "><b><h3>
                Edit Perawat
            </h3></b></div>
            <div class="card-body">
                     <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Nama Perawat</label>
                            <input type="text" name="nama_dokter" class="form-control @error('nama_dokter') is-invalid @enderror" id="nama_dokter" value="{{ old('dokter',$dokter->nama_dokter )}}" autofocus placeholder="Nama Barang">
                            @error('nama_dokter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <label for="gambar_dokter" class="form-label">Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('gambar_dokter') is-invalid @enderror" id="gambar_dokter" name="gambar_dokter" accept="image/*">
                                <label class="custom-file-label" for="gambar_dokter"></label>
                            </div>
                        </div>
                        @error('gambar_dokter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($dokter->gambar_dokter)
                        <div class="mb-3">
                            <label for="gambar_dokter" class="form-label">Gambar saat ini:</label>
                            <img src="{{ asset('img/'.$dokter->gambar_dokter) }}" alt="Gambar dokter ">
                        </div>
                    @endif
            
                                         
                        <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Jenis kelamin</label>
    <select name="jenis_kelamin" class="form-control">
        <option value="">- Pilih -</option>
        <option value="L" {{ $dokter->jenis_kelamin === 'L' ? 'selected' : '' }}>L</option>
        <option value="P" {{ $dokter->jenis_kelamin === 'P' ? 'selected' : '' }}>P</option>
    </select>
</div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Umur</label>
                            <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" id="umur" value="{{ old('dokter',$dokter->umur )}}" autofocus placeholder="Umur">
                            @error('umur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">No HP</label>
                            <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" value="{{ old('dokter',$dokter->no_hp)}}" autofocus placeholder="no_hp">
                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('dokter',$dokter->email)}}" autofocus placeholder="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="/dokter" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>

</div>

@endsection
