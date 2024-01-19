@extends('admin.layouts.main')

@section('styles')
<style>
    /* Styles for responsive layout */
    @media (max-width: 767px) {
        .card-tools {
            flex-direction: column;
            align-items: center;
        }

        .card-tools a {
            margin-bottom: 10px;
        }
    }

    /* Additional styles for table */
    .table-responsive {
        margin-top: 20px;
    }

    .table {
        width: 100%;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .table th {
        background-color: #f8f9fa; /* Background color for header */
    }

    .table th,
    .table td {
        padding: 8px 12px;
    }

    .table td {
        vertical-align: middle;
    }
</style>
@endsection

@section('container')
    <div class="pagetitle">
        <h1>Pendapatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Pendapatan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table Rekam Medis</h5><br>
            <div class="card-tools">
                @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/pendapatan/create" class="btn btn-success">
                                <i class="fas fa-plus-square"></i> Tambah Data
                            </a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('cetak-pdf') }}" method="post">
                                @csrf
                                <label for="tanggal">Pilih Bulan:</label>
                                <input type="month" name="month" id="month">
                                <button type="submit" class="btn btn-success">Cetak PDF</button>
                            </form>
                        </div>
                    </div>
            </div>
            @endif
            <form action="{{ url('/pendapatan') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control rounded-pill"
                        placeholder="Search Pelayanan dan Kode Pelayanan " value="{{ $search }}">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
    <tr>
        <th scope="col" class="text-center">No</th>
        <th scope="col" class="text-center">Kode Pendapatan</th>
        <th scope="col" class="text-center">Tanggal</th>
        <th scope="col" class="text-center">Kode Rekam Medis</th>
        <th scope="col" class="text-center">Pelayanan</th>
        <th scope="col" class="text-center">Harga</th>
        <th scope="col" class="text-center">Kode Resep</th>
        <th scope="col" class="text-center">Harga Obat</th>
        <th scope="col" class="text-center">Spesialisasi</th>
        <th scope="col" class="text-center">Harga Spesialisasi</th>
        <th scope="col" class="text-center">Total</th>
        @php
            $user = Auth::guard('dokter')->user() ?? Auth::user();
        @endphp

        @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
        @else
            <th colspan="2" scope="col" class="text-center">Aksi</th>
        @endif
    </tr>
</thead>
<tbody>
    @foreach ($pendapatans as $pendapatan)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $pendapatan->kode_pendapatan }}</td>
            <td class="text-center">{{ date('d-m-Y', strtotime($pendapatan->tanggal)) }}</td>
            <td class="text-center">{{ $pendapatan->rekam_medis ? $pendapatan->rekam_medis->kode_rekam_medis : '-' }}</td>
            <td class="text-center">{{ $pendapatan->pelayanan }}</td>
            <td class="text-center"> Rp {{ number_format($pendapatan->harga, 0, ',', '.') }}</td>
            <td class="text-center">{{ $pendapatan->resep_obat ? $pendapatan->resep_obat->resep_id : '-' }}</td>
            <td class="text-center"> Rp {{ number_format($pendapatan->harga_obat, 0, ',', '.') }}</td>
            <td class="text-center">{{ $pendapatan->spesialisasi }}</td>
            <td class="text-center"> Rp {{ number_format($pendapatan->harga_spesialisasi, 0, ',', '.') }}</td>
            <td class="text-center"> Rp {{ number_format($pendapatan->total, 0, ',', '.') }}</td>
            @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
            @else
              <td class="text-center">
    <div class="btn-group">
        <a href="/pendapatan/{{ $pendapatan->id }}/edit" class="btn btn-primary btn-sm"><i class="fas fa-pen-to-square"></i></a>
        <form action="/pendapatan/{{ $pendapatan->id }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i class="fas fa-trash-alt"></i></button>
        </form>
    </div>
</td>

            @endif
        </tr>
    @endforeach
</tbody>

            </div>
            </table>
            <tr>
                        <td colspan="8" class="text-right"><strong>Total Pendapatan:</strong></td>
                        <td class="text-center"><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>

                        <td colspan="2"></td>
                    </tr>
            {{ $pendapatans->links() }}
        </div>

    </div>
    </div>
    @include('sweetalert::alert')
@endsection
