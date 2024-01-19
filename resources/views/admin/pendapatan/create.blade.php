@extends('admin.layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <form action="/pendapatan" method="post">
                    @csrf
                    <div class="card">
                        <h5 class="card-header text-center">pendapatan</h5><br>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kode Pendapatan</label>
                                <input type="text" class="form-control @error('kode_pendapatan') is-invalid @enderror"
                                    id="kode_pendapatan" name="kode_pendapatan"
                                    value="{{ old('kode_pendapatan', 'KP-' . $kd) }}" readonly>
                                @error('kode_pendapatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"
                                    style="text-align: center;">Tanggal</label>
                                <input type="date" name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                    value="{{ old('tanggal', date('Y-m-d')) }}" autofocus placeholder="tanggal" readonly>
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <script>
                                // Dapatkan elemen input tanggal
                                const tanggalInput = document.getElementById("tanggal");

                                // Atur nilai input tanggal ke tanggal sekarang (dalam format YYYY-MM-DD)
                                const today = new Date();
                                const dd = String(today.getDate()).padStart(2, "0");
                                const mm = String(today.getMonth() + 1).padStart(2, "0"); // Januari dimulai dari 0
                                const yyyy = today.getFullYear();
                                const currentDate = `${yyyy}-${mm}-${dd}`;
                                tanggalInput.value = currentDate;
                            </script>

                            <div class="row">
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Kode Rekam Medis</label>
                                    <select class="form-select" name="kode_rekam_medis"
                                        aria-label="Default select   example">
                                        <option selected></option>
                                        @foreach ($rekam_medis as $rm)
                                            @if (old('jurusan_id') == $rm->id)
                                                <option value="{{ $rm->id }}" selected>{{ $rm->kode_rekam_medis }}
                                                </option>
                                            @else
                                                <option value="{{ $rm->id }}">{{ $rm->kode_rekam_medis }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label"
                                        style="text-align: center;">Pelayanan</label>
                                    <input type="text" name="pelayanan"
                                        class="form-control @error('pelayanan') is-invalid @enderror" id="pelayanan"
                                        value="{{ old('pelayanan') }}" autofocus placeholder="pelayanan">
                                    @error('pelayanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>




                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label"
                                        style="text-align: center;">Harga</label>
                                    <input type="number" name="harga"
                                        class="form-control @error('harga') is-invalid @enderror" id="harga"
                                        value="{{ old('harga') }}" autofocus placeholder="Harga">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="resep_id" class="form-label">Kode Resep Obat</label>
                                    <select class="form-select" name="resep_id" aria-label="Default select example"
                                        id="resep_id">
                                        <option selected></option>
                                        <?php
        $usedCodes = []; // Untuk melacak kode resep yang sudah ditampilkan
        foreach($resep_obats as $rs) {
            if (!in_array($rs->resep_id, $usedCodes)) {
                $usedCodes[] = $rs->resep_id; // Menambahkan kode ke dalam daftar yang sudah ditampilkan
        ?>
                                        <option value="{{ $rs->id }}" data-total-harga="{{ $rs->total_harga }}">
                                            {{ $rs->resep_id }}
                                        </option>
                                        <?php
            }
        }
        ?>
                                    </select>

                                </div>


                                <div class="mb-3">
                                    <label for="harga_obat" class="form-label" style="text-align: center;">Harga
                                        Obat</label>
                                    <input type="number" name="harga_obat"
                                        class="form-control @error('harga_obat') is-invalid @enderror" id="harga_obat"
                                        value="{{ old('harga_obat') }}" autofocus placeholder="harga_obat">
                                    @error('harga_obat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                              <div class="mb-3">
    <label for="spesialisasi" class="form-label" style="text-align: center;">Pilih Spesialisasi</label>
    <select name="spesialisasi" class="form-select @error('spesialisasi') is-invalid @enderror" id="spesialisasi">
        <option value="" disabled selected>Pilih Spesialisasi</option>
        <option value="Sunat">Sunat</option>
        <option value="Perawatan Luka">Perawatan Luka</option>
    </select>
    @error('spesialisasi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" style="text-align: center;">Harga Spesialisasi</label>
    <input type="number" name="harga_spesialisasi" class="form-control @error('harga_spesialisasi') is-invalid @enderror"
        id="harga_spesialisasi" value="{{ old('harga_spesialisasi') }}" autofocus placeholder="harga_spesialisasi">
    @error('harga_spesialisasi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<script>
    document.getElementById('spesialisasi').addEventListener('change', function() {
        var selectedSpesialisasi = this.value;
        var hargaSpesialisasiInput = document.getElementById('harga_spesialisasi');

        // Mengatur harga otomatis berdasarkan pilihan spesialisasi
        if (selectedSpesialisasi === 'Sunat') {
            hargaSpesialisasiInput.value = '300000';
        } else if (selectedSpesialisasi === 'Perawatan Luka') {
            hargaSpesialisasiInput.value = '150000';
        } else {
            // Harga default jika tidak ada yang dipilih
            hargaSpesialisasiInput.value = '';
        }
    });
</script>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="/pendapatan" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
                                    <button name="submit" class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>

                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <script>
        const resepSelect = document.getElementById('resep_id');
        const hargaObatInput = document.getElementById('harga_obat');

        resepSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const totalHarga = selectedOption.getAttribute('data-total-harga');
            console.log('Selected Total Harga:', totalHarga); // Debugging line
            hargaObatInput.value = totalHarga || '';
        });
    </script>
@endsection
