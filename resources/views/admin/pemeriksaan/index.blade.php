@extends('admin.layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Pemeriksaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Pemeriksaan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table pemeriksaan</h5><br>
            <div class="card-tools">
                @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user && $user->role == 'Dokter')
                    <a href="/pemeriksaan/create" class="btn btn-success"><i class="fas fa-plus-square"></i>Tambah Data</a>
            </div>
            @endif

            <form action="{{ url('/pemeriksaan') }}" method="GET">
                 <div class="input-group mt-4">
                        <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Name "
                            value="{{ $search }}">
                        <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                    </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Kode Pemeriksaan</th>
                            <th scope="col" class="text-center">Tanggal</th>
                            <th scope="col" class="text-center">Nama Pasien</th>
                            <th scope="col" class="text-center">Nama Perawat</th>
                            <th scope="col" class="text-center">Tekanan Darah</th>
                            <th scope="col" class="text-center">Suhu Badan</th>
                            <th scope="col" class="text-center">Keluhan</th>
                            @php
                                $user = Auth::guard('dokter')->user() ?? Auth::user();
                            @endphp

                            @if ($user && $user->role == 'Dokter')
                                <th scope="col" class="text-center">Options</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pemeriksaans as $pemeriksaan)
                            <tr>
                                {{-- @php
                            dd($rm);
                        @endphp --}}
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $pemeriksaan->kode_pemeriksaan }}</td>
                                <td class="text-center">{{ $pemeriksaan->tanggal }}</td>
                                <td class="text-center">{{ $pemeriksaan->pasien ? $pemeriksaan->pasien->nama_pasien : '-' }}
                                </td>
                                <td class="text-center">{{ $pemeriksaan->dokter ? $pemeriksaan->dokter->nama_dokter : '-' }}
                                </td>
                                <td class="text-center">{{ $pemeriksaan->tekanan_darah }}</td>
                                <td class="text-center">{{ $pemeriksaan->suhu_badan }}</td>
                                <td class="text-center">{{ $pemeriksaan->keluhan }}</td>

                                @php
                                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                                @endphp

                                @if ($user && $user->role == 'Dokter')
                                    <td class="text-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="/pemeriksaan/{{ $pemeriksaan->id }}/edit"
                                                class="btn btn-primary btn-sm"><i class="fas fa-pen-to-square"></i></a>
                                            <form action="/pemeriksaan/{{ $pemeriksaan->id }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Akan Menghapus Data..?')"
                                                    type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
            </div>

            </tbody>

            </table>
        </div>
        {{ $pemeriksaans->links() }}
    </div>
    @include('sweetalert::alert')
@endsection
