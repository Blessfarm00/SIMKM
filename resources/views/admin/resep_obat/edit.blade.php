@extends('admin.layouts.main')

@section('container')
    <div class="card">
        <h5 class="card-header">Resep Obat</h5>
        <div class="card-body">
            <form method="post" action="/resep_obat/{{ $resep_obat->id }}">
                @method('PUT')
                @csrf

                <div class="card border-dark mb-3">
                    <div class="card-header text-center "><b>
                            <h3>
                                Edit resep-obat
                            </h3>
                        </b></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kode Resep Obat</label>
                                <input type="text" class="form-control @error('resep_id') is-invalid @enderror"
                                    id="resep_id" name="resep_id" value="{{ old('resep_obat', $resep_obat->resep_id) }}"
                                    readonly autofocus>
                                @error('resep_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                           <div class="mb-3">
    <label for="rekam_medis_id" class="form-label">Kode Rekam Medis</label>
    <select class="form-select" name="rekam_medis_id" aria-label="Default select example" disabled>
        <option selected disabled></option>
        @foreach ($rekam_medis as $rm)
            <option value="{{ $rm->id }}" 
                {{ ($rm->id == $resep_obat->rekam_medis_id) ? 'selected' : '' }}>
                {{ $rm->kode_rekam_medis }}
            </option>
        @endforeach
    </select>
</div>


                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Obat</th>
                                        <th>Jumlah Obat</th>
                                        <th>Keterangan</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody id="obatTableBody">
                                    <tr class="obat-row">
                                        <td>
                                            <select class="form-select obat-select" name="obat_ids[]" aria-label="Obat">
                                                <option value="" disabled selected>Pilih Obat</option>
                                                @foreach ($obats as $obat)
                                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}" >
                                                        {{ $obat->merek_obat }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jumlah_obat[]"
                                                placeholder="Jumlah Obat" >
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="keterangan[]"
                                                placeholder="Keterangan Obat">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control harga-obat" name="harga[]"
                                                placeholder="Harga Obat" value="{{ $resep_obat->harga }}" readonly>.
                                        </td>
                                        <td>
                                            <!-- Tombol "Hapus" pada baris pertama dihapus -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" id="tambahObatButton" class="btn btn-secondary">Tambah Obat</button>

                            <div class="modal-footer">


                                <a href="/resep-obat" class="btn btn-outline-danger col-md-3 offset-md-8">Kembali</a>

                                <button type="submit" name="submit"
                                    class="btn btn-success col-md-3 offset-md-8 mt-3">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const tambahObatButton = document.getElementById("tambahObatButton");
            const obatTableBody = document.getElementById("obatTableBody");
    
        const obatSelects = document.querySelectorAll(".obat-select");
        const hargaInputs = document.querySelectorAll(".harga-obat");

            tambahObatButton.addEventListener("click", function() {
                const obatRow = document.querySelector(".obat-row").cloneNode(true);

                // Tambah tombol "Hapus" pada baris baru
                const hapusButton = document.createElement("button");
                hapusButton.className =
                    "btn btn-danger btn-sm hapusObatButton"; // Ganti kelas tombol menjadi "btn btn-danger btn-sm hapusObatButton"
                hapusButton.type = "button";
                hapusButton.textContent = "Hapus";

                // Tambah event listener untuk tombol "Hapus" pada baris baru
                hapusButton.addEventListener("click", function() {
                    obatTableBody.removeChild(obatRow);
                });

                obatRow.querySelector("td:last-child").appendChild(
                    hapusButton); // Tambah tombol ke dalam sel terakhir pada baris baru
                obatTableBody.appendChild(obatRow);

                updateTotalHarga();
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

            obatTableBody.addEventListener("click", function(event) {
                const target = event.target;
                if (target.classList.contains("hapusObatButton")) {
                    target.closest(".obat-row").remove();
                }
            });
            obatSelects.forEach(function(obatSelect) {
            obatSelect.addEventListener("change", function() {
                const selectedOption = obatSelect.options[obatSelect.selectedIndex];
                const selectedHarga = selectedOption.getAttribute("data-harga");
                const hargaInput = obatSelect.closest(".obat-row").querySelector(".harga-obat");
                hargaInput.value = selectedHarga ? selectedHarga : "";
                updateTotalHarga(); // Pastikan Anda memiliki fungsi updateTotalHarga untuk memperbarui total harga jika diperlukan
            });
        });
        });
    </script>
@endsection
