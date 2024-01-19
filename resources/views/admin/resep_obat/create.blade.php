@extends('admin.layouts.main')

@section('container')

<div class="card">
    <h5 class="card-header">Resep Obat</h5>
    <div class="card-body">
        <form action="/resep-obat" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kode Resep Obat</label>
                <input type="text" class="form-control @error('resep_id') is-invalid @enderror" id="resep_id" name="resep_id" value="{{old('resep_id','KRO-'.$kd)}}" readonly autofocus>
                @error('resep_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rekam_medis_id" class="form-label">Kode Rekam Medis</label>
                <select class="form-select" name="rekam_medis_id" aria-label="Default select example">
                    <option selected></option>
                    @foreach($rekam_medis as $rm)
                        <option value="{{ $rm->id }}">{{ $rm->kode_rekam_medis }}</option>
                    @endforeach
                </select>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Obat</th>
                        <th>Jumlah Obat</th>
                        <th>Keterangan</th>
                        <th>Harga Obat</th>
                         <th>Total Harga</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody id="obatTableBody">
                    <!-- Baris obat pertama (template) -->
                   <tr class="obat-row">
                        <td>
                            <select class="form-select obat-select" name="obat_ids[]" aria-label="Obat">
                                <option value="" disabled selected>Pilih Obat</option>
                                @foreach($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->merek_obat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="jumlah_obat[]" placeholder="Jumlah Obat">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan Obat">
                        </td>
                        <td>
                            <input type="text" class="form-control harga-obat" name="harga[]" placeholder="Harga Obat" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control harga-total" name="harga_total[]" placeholder="Harga Total" readonly>
                        </td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm hapusObatButton">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" id="tambahObatButton" class="btn btn-secondary">Tambah Obat</button>

            <div id="totalHargaContainer" class="mt-3">
                <label for="totalHarga">Total Harga:</label>
                <input type="text" class="form-control" id="totalHarga" name="total_harga" readonly>
            </div>

            <div class="modal-footer">
                <a href="/resep-obat" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tambahObatButton = document.getElementById("tambahObatButton");
    const obatTableBody = document.getElementById("obatTableBody");
    const totalHargaInput = document.getElementById("totalHarga");

    function hitungTotalHarga() {
        const rows = document.querySelectorAll(".obat-row");
        let totalHarga = 0;

        rows.forEach((row) => {
            const hargaInput = row.querySelector(".harga-obat");
            const jumlahInput = row.querySelector("input[name='jumlah_obat[]']");
            const harga = parseFloat(hargaInput.value) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            const hargaTotal = harga * jumlah;
            const hargaTotalInput = row.querySelector(".harga-total");
            hargaTotalInput.value = hargaTotal.toLocaleString("id-ID", { style: "currency", currency: "IDR" });
            totalHarga += hargaTotal;
        });

        return totalHarga;
    }

    tambahObatButton.addEventListener("click", function() {
        const obatRow = document.querySelector(".obat-row").cloneNode(true);
        obatTableBody.appendChild(obatRow);
        const hapusButton = obatRow.querySelector(".hapusObatButton");
        hapusButton.style.display = "block"; // Menampilkan tombol hapus pada baris baru
        updateTotalHarga(); // Perbarui total harga setelah menambah obat
    });

    obatTableBody.addEventListener("click", function(event) {
        const target = event.target;
        if (target.classList.contains("hapusObatButton")) {
            const obatRow = target.closest(".obat-row");
            obatTableBody.removeChild(obatRow);
            updateTotalHarga(); // Perbarui total harga setelah menghapus obat
        }
    });

    obatTableBody.addEventListener("change", function(event) {
        const target = event.target;
        if (target.classList.contains("obat-select")) {
            const selectedOption = target.options[target.selectedIndex];
            const selectedHarga = selectedOption.getAttribute("data-harga");
            const hargaInput = target.closest(".obat-row").querySelector(".harga-obat");
            hargaInput.value = selectedHarga ? selectedHarga : "";

            updateTotalHarga(); // Perbarui total harga setelah mengubah obat
        }
    });

    function updateTotalHarga() {
        totalHargaInput.value = hitungTotalHarga().toLocaleString("id-ID", { style: "currency", currency: "IDR" });
    }

    // Sembunyikan tombol hapus pada baris pertama
    const tombolHapusPertama = obatTableBody.querySelector(".obat-row .hapusObatButton");
    if (tombolHapusPertama) {
        tombolHapusPertama.style.display = "none";
    }

    // Pertama kali, lakukan perhitungan total harga
    updateTotalHarga();
});
</script>

@endsection