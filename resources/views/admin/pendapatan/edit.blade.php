@extends('admin.layouts.main')
@section('container')

<div class="row justify-content-center p-5">
    <div class="col-lg-6">
        <form method="post" action="/pendapatan/{{ $pendapatan->id }}">
            @method('PUT')
            @csrf
            <div class="card border-dark mb-3">
                <div class="card-header text-center"><b><h3>Edit Pendapatan</h3></b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="pelayanan" class="form-label" style="text-align: center;">Pelayanan</label>
                            <input type="text" name="pelayanan" class="form-control @error('pelayanan') is-invalid @enderror" id="pelayanan" value="{{ old('pelayanan', $pendapatan->pelayanan) }}" autofocus placeholder="Pelayanan">
                            @error('pelayanan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label" style="text-align: center;">Harga</label>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" value="{{ old('harga', $pendapatan->harga) }}" autofocus placeholder="Harga">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="harga_obat" class="form-label" style="text-align: center;">Harga Obat</label>
                            <input type="number" name="harga_obat" class="form-control @error('harga_obat') is-invalid @enderror" id="harga_obat" value="{{ old('harga_obat', $pendapatan->harga_obat) }}" autofocus placeholder="harga_obat">
                            @error('harga_obat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="tanggal" class="form-label" style="text-align: center;">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('tanggal', $pendapatan->tanggal) }}" autofocus>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        

                        <a href="/pendapatan" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                        <button type="submit" name="submit" class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const resepSelect = document.getElementById('resep_id');
    const hargaObatInput = document.getElementById('harga_obat');

    resepSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const totalHarga = selectedOption.getAttribute('data-total-harga');
        console.log('Selected Total Harga:', totalHarga); // Debugging line
        hargaObatInput.value = totalHarga || '';
    });
</script>@endsection
