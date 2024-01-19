@extends('admin.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Resep Obat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Resep obat</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table Resep Obat</h5><br>
            @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp
            @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
            @else
                <div class="card-tools">
                    <a href="/resep-obat/create" class="btn btn-success"><i class="fas fa-plus-square"></i>Tambah Data</a>
                </div>
            @endif

            <hr>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Resep</th>
                        <th>ID Rekam Medis</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Obat</th>
                        <th>Keterangan</th>
                        <th>Total Harga</th>
                        @php
                            $user = Auth::guard('dokter')->user() ?? Auth::user();
                        @endphp
                        @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
                        @else
                            <th>Options</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentResepId = null;
                    @endphp

                    @php
                        $indexResep = 0;
                    @endphp
                    @foreach ($resep_obats as $index => $resep_obat)
                        @if ($currentResepId !== $resep_obat->resep_id)
                            @php
                                $currentResepId = $resep_obat->resep_id;
                                $matchingResepObats = $resep_obats->where('resep_id', $resep_obat->resep_id);
                            @endphp
                            <tr>
                                <td rowspan="{{ count($matchingResepObats) }}">{{ ++$indexResep }}</td>
                                <td rowspan="{{ count($matchingResepObats) }}">{{ $resep_obat->resep_id }}</td>
                                <td rowspan="{{ count($matchingResepObats) }}">
                                    {{ $resep_obat->rekam_medis ? $resep_obat->rekam_medis->kode_rekam_medis : '-' }}</td>
                                <td>{{ $resep_obat->obat->merek_obat }}</td>
                                <td>{{ $resep_obat->jumlah_obat }}</td>
                                <td>{{ $resep_obat->keterangan }}</td>
                                <td rowspan="{{ count($matchingResepObats) }}">
                                    @php
                                        $totalHarga = 0;
                                    @endphp
                                    @foreach ($matchingResepObats as $matchingResepObat)
                                        @php
                                            $totalHarga += $matchingResepObat->harga * $matchingResepObat->jumlah_obat;
                                        @endphp
                                    @endforeach
                                    {{ number_format($totalHarga, 0, ',', '.') }}
                                </td>
                                @php
                                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                                @endphp
                                @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
                                @else
                                    <td class="text-center">
                                        <a href="/resep-obat/{{ $resep_obat->id }}/edit" class="btn btn-primary btn-sm"><i
                                                class="fas fa-pen-to-square"></i></a>
                                        <form action="/resep-obat/{{ $resep_obat->resep_id }}" method="post"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @php
                                $matchingResepObats = $matchingResepObats->skip(1); // Skip the first element
                            @endphp
                            @foreach ($matchingResepObats as $matchingResepObat)
                                <tr>
                                    <td>{{ $matchingResepObat->obat->merek_obat }}</td>
                                    <td>{{ $matchingResepObat->jumlah_obat }}</td>
                                    <td>{{ $matchingResepObat->keterangan }}</td>
                                    <td> <!-- Kosongkan kolom Options untuk baris ini --> </td>



                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>

            {{ $grouped_resep_obats->links() }}
        </div>
        @include('sweetalert::alert')
    </div>
    </div>
@endsection
