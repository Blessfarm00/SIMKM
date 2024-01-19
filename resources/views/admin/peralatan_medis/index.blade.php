@extends('admin.layouts.main')


@section('container')

    
    <div class="pagetitle">
        <h1>Peralatan Medis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Peralatan Medis</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            
            <h5 class="card-header text-center">Table Peralatan Medis</h5><br>
            <div class="card-tools">
                @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                <a href="/peralatan_medis/create" class="btn btn-success"><i class="fas fa-plus-square"></i>Tambah Data</a>
            </div>
        @endif
            <form action="{{ url('/peralatan_medis') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Name dan keterangan " value="{{ $search }}">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </form>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Kode Alat</th>
                        <th scope="col" class="text-center">Nama Alat</th>
                        <th scope="col" class="text-center">Gambar Alat</th>
                        <th scope="col" class="text-center">Jumlah Alat</th>
                        <th scope="col" class="text-center">keterangan</th>
                       @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <th colspan="2" scope="col" class="text-center">Aksi</th>
                @endif
                    </tr>
                </thead>
                <tbody>

                    {{-- @php
                    dd($peralatan_mediss->items);
                @endphp --}}

                    @foreach ($peralatan_medis as $pm)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center"> {{ $pm->kode_alat }}</td>
                        <td class="text-center">{{ $pm->nama_alat }}</td>
                        <td class="text-center">
                            @if ($pm->gambar_alat)
                                <img id="myImg"
                                src="{{ url('img') . '/' . $pm->gambar_alat }}"
                                alt="{{ $pm->gambar_alat }}" class="rounded-circle" width="60px" height="60px" >
                            @endif
                        </td>
                        <td class="text-center">{{ $pm->jumlah_alat }}</td>
                        <td class="text-center">{{ $pm->keterangan }}</td>

                           @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <td>
                            <a href="/peralatan_medis/{{ $pm->id }}/edit" class="btn btn-primary btn-sm"> <i class="fas fa-pen-to-square"></i></a>
                         <form action="/peralatan_medis/{{ $pm->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                @endif
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{ $peralatan_medis->links() }}
        </div>
@include('sweetalert::alert')
        @endsection