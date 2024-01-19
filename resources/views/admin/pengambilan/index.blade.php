@extends('admin.layouts.main')

@section('container')
    
    <div class="pagetitle">
        <h1>Pengambilan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Pengambilan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table Pengambilan</h5><br>
               @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
            <div class="card-tools">
                <a href="/pengambilan/create" class="btn btn-success"><i class="fas fa-plus-square"></i> Tambah Data</a>
            </div>
            @endif
                <form action="{{ url('/pengambilan') }}" method="GET">
                    <div class="input-group mt-4">
                        <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Keterangan">
                        <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                    </div>
                </form>

            <hr>
            <table class="table table-bordered">
                <thead>
                        <tr>
                            <th scope="col"class="text-center">No</th>
                            <th scope="col"class="text-center">Nama Obat</th>
                            <th scope="col"class="text-center">Jumlah Obat</th>
                               @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                            <th scope="col"class="text-center">Aksi</th>
                @endif
                </thead>
                <tbody>

                          @foreach ($pengambilans as $pengambilan)
                        <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>  
                        <td class="text-center">{{ $pengambilan->obat ? $pengambilan->obat->nama_obat : '-'   }}</td>
                        <td class="text-center">{{ $pengambilan->jumlah}}</td>
                           @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <td class="text-center">
                        <a href="/pengambilan/{{ $pengambilan->id }}/edit" class="btn btn-primary btn-sm" title="Edit">
                        <i class="fas fa-pen-to-square"></i> 
                        </a>
                        <form action="/pengambilan/{{ $pengambilan->id }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit" title="Delete">
                                <i class="fas fa-trash-alt"></i> 
                            </button>
                        </form>
                            </td>
                @endif

                    </tr>
                    @endforeach

                </tbody>

            </table>
            
        </div>
        </div>
    </div>
            
@include('sweetalert::alert')
        @endsection