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
</style>
@endsection

@section('container')
    
    <div class="pagetitle">
        <h1>Sunat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Sunat</li>
            </ol>
        </nav>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table Sunat</h5><br>
            <div class="card-tools">
                @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                <a href="/sunat/create" class="btn btn-success"><i class="fas fa-plus-square"></i>Tambah Data</a>
            </div>
        @endif
            <form action="{{ url('/sunat') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Kode sunat " value="{{ $search }}">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </form>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Kode sunat</th>
                        <th scope="col" class="text-center">Nama Pasien</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center">Nama Perawat</th>
                        <th scope="col" class="text-center">Umur</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Keterangan</th>
                        <th scope="col" class="text-center">Pengerjaan</th>
                           @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <th scope="col" class="text-center">Options</th>
                    @endif
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sunat as $sunat)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $sunat->kode_sunat }}</td>
                        <td class="text-center">{{ $sunat->nama_pasien }}</td>
                        <td class="text-center">{{ $sunat->alamat }}</td>
                        <td class="text-center">{{ $sunat->dokter ? $sunat->dokter->nama_dokter : '-' }}</td>
                        <td class="text-center">{{ $sunat->umur }}</td>
                        <td class="text-center">{{ $sunat->tanggal }}</td>
                        <td class="text-center">{{ $sunat->keterangan }}</td>
                        <td class="text-center">{{ $sunat->pengerjaan }}</td>
                           @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <td class="text-center">
                            <a href="/sunat/{{ $sunat->id }}/edit" class="btn btn-primary btn-sm"><i class="fas fa-pen-to-square"></i></a>

                            <form action="/sunat/{{ $sunat->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        
                            <form action="/sunat/{{ $sunat->id }}/selesai" method="post" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Anda yakin ingin menandai sebagai Diterima?')" type="submit"><i class="fas fa-check"></i></button>
                            </form>
                        </td>
                @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $sunat->links() }} --}}
        </div>
        @include('sweetalert::alert')
    </div>
@endsection
