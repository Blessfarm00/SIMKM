@extends('admin.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Rekam Medis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Rekam Medis</li>
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

                @if ($user && $user->role == 'Dokter')
                    <a href="/rekam-medis/create" class="btn btn-success"><i class="fas fa-plus-square"></i>Tambah Data</a>
            </div>
            @endif

            <form action="{{ url('/rekam-medis') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control rounded-pill"
                        placeholder="Search by Diagnosa dan Kode Rekam medis " value="{{ $search }}">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </form>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"class="text-center">No</th>
                        <th scope="col"class="text-center">Kode Rekam Medis</th>
                        <th scope="col"class="text-center">Kode Pemeriksaan</th>
                        <th scope="col"class="text-center">Nama Pasien</th>
                        <th scope="col"class="text-center">Diagnosa</th>
                        <th scope="col"class="text-center">Tindakan</th>
                        <th scope="col"class="text-center">Rujukan</th>
                        @php
                            $user = Auth::guard('dokter')->user() ?? Auth::user();
                        @endphp

                        @if ($user && $user->role == 'Dokter')
                            <th scope="col" class="text-center">Options</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekam_medis as $rm)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $rm->kode_rekam_medis }}</td>
                            <td class="text-center">{{ $rm->pemeriksaan ? $rm->pemeriksaan->kode_pemeriksaan : '-' }}</td>
                            <td class="text-center">{{ $rm->pasien ? $rm->pasien->nama_pasien : '-' }}</td>
                            <td class="text-center">{{ $rm->diagnosa }}</td>
                            <td class="text-center">{{ $rm->tindakan }}</td>
                            <td class="text-center">{{ $rm->rujukan }}</td>
                            @php
                                $user = Auth::guard('dokter')->user() ?? Auth::user();
                            @endphp

                            @if ($user && $user->role == 'Dokter')
                                <td class="text-center">
                                    <div class="d-flex justify-content-between align-items-center">

                                        <a href="/rekam_medis/{{ $rm->id }}/edit" class="btn btn-primary btn-sm"><i
                                                class="fas fa-pen-to-square"></i></a>
                                        <form action="/rekam-medis/{{ $rm->id }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>


                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>

            </table>
            {{ $rekam_medis->links() }}
        </div>
        @include('sweetalert::alert')
    @endsection
