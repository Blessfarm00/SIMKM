@extends('admin.layouts.main')

@section('container')

<div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Daftar No Antrian</h5><br>
            <div class="card-tools">
        </div>
        <div class="card-body">
           <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nomor Antrian</th>
                        <th>Waktu Dibuat</th>
                        <th> Status
                        <button id="btnSelesai" class="btn btn-success btn-sm" style="display: none;">Selesai</button>
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrians as $antrian)
                        <tr>
                            <td>{{ $antrian->nomor }}</td>
                          <td>{{ $antrian->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y') }}</td>
                            <td>
                                <input type="checkbox" class="check-antrian" data-antrian="{{ $antrian->id }}" id="antrian_{{ $antrian->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form method="POST" action="{{ route('reset-otomatis') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Reset No Antrian</button>
                </form>
            {{$antrians->links()}}
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll(".check-antrian");

        checkboxes.forEach(checkbox => {
            const antrianId = checkbox.getAttribute("data-antrian");
            const localStorageKey = `antrian_${antrianId}`;

            const storedValue = localStorage.getItem(localStorageKey);

            if (storedValue === null) {
                localStorage.setItem(localStorageKey, "false");
            } else {
                checkbox.checked = storedValue === "true";
            }

            checkbox.addEventListener("change", function () {
                if (this.checked) {
                    localStorage.setItem(localStorageKey, "true");
                } else {
                    localStorage.setItem(localStorageKey, "false");
                }
            });
        });
    });
</script>



@endsection