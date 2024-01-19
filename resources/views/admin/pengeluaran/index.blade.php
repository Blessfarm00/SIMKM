@extends('admin.layouts.main')

@section('container')
    
    <div class="pagetitle">
        <h1>Pemasukan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Pemasukan</li>
            </ol>
        </nav>
    </div>
       
    <div class="card">
       
        <div class="card-body">
            <h5 class="card-header text-center">Table Pemasukan</h5><br>
            <div class="card-tools">
                 @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                <a href="/pengeluaran/create" class="btn btn-success"><i class="fas fa-plus-square"></i> Tambah Data</a>
            </div>
            @endif
                <form action="{{ url('/pengeluaran') }}" method="GET">
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
                            <th scope="col"class="text-center">Kode Pemasukan</th>
                            <th scope="col"class="text-center">Nama Obat</th>
                            <th scope="col"class="text-center">Jumlah Obat</th>
                            <th scope="col"class="text-center">Keterangan</th>
                               @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                            <th scope="col"class="text-center">Aksi</th>
                @endif
                    </tr>
                </thead>
                <tbody>

                          @foreach ($pengeluarans as $pengeluaran)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $pengeluaran->kode_pengeluaran  }}</td>
                            <td class="text-center">{{ $pengeluaran->obat ? $pengeluaran->obat->merek_obat : '-'   }}</td>
                            <td class="text-center">{{ $pengeluaran->jumlah}}</td>
                            <td class="text-center">{{ $pengeluaran->keterangan}}</td>
                           @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <td class="text-center">
                        <a href="/pengeluaran/{{ $pengeluaran->id }}/edit" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-pen-to-square"></i> 
                        </a>
                        <form action="/pengeluaran/{{ $pengeluaran->id }}" method="post" class="d-inline">
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
            {{ $pengeluarans->links() }}
        </div>
        </div>
    </div>
@include('sweetalert::alert')
        @endsection