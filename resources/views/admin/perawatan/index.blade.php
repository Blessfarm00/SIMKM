@extends('admin.layouts.main')

@section('container')
    
    <div class="pagetitle">
        <h1>Perawatan Luka</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Perawatan Luka</li>
            </ol>
        </nav>
    </div>
      
    <div class="card">
        
        <div class="card-body">
            <h5 class="card-header text-center">Table Perawatan Luka</h5><br>
            <div class="card-tools">
                 @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                <a href="/perawatan/create" class="btn btn-success"><i class="fas fa-plus-square"></i>Tambah Data</a>
            </div>
        @endif
            <form action="{{ url('/perawatan') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Kode perawatan " value="{{ $search }}">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </form>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Kode perawatan</th>
                        <th scope="col" class="text-center">Nama Pasien</th>
                        <th scope="col" class="text-center">Alamat</th>
                        <th scope="col" class="text-center">Nama Perawat</th>
                        <th scope="col" class="text-center">Jenis Luka</th>
                         <th scope="col" class="text-center">Status</th>
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
                    @foreach ($perawatanLuka as $perawatan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $perawatan->kode_perawatan }}</td>
                        <td class="text-center">{{ $perawatan->nama_pasien }}</td>
                        <td class="text-center">{{ $perawatan->alamat }}</td>
                        <td class="text-center">{{ $perawatan->dokter ? $perawatan->dokter->nama_dokter : '-' }}</td>
                        <td class="text-center">{{ $perawatan->jenis_luka }}</td>
                        <td class="text-center">{{ $perawatan->status }}</td>
                        <td class="text-center">{{ $perawatan->pengerjaan }}</td>
                      
                      
   @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                        <td class="text-center">
                            <a href="/perawatan/{{ $perawatan->id }}/edit" class="btn btn-primary btn-sm"><i class="fas fa-pen-to-square"></i></a>

                            <form action="/perawatan/{{ $perawatan->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <form action="/perawatan/{{ $perawatan->id }}/selesai" method="post" class="d-inline">
                                @csrf
                               
                            </form>
                        </td>
                    @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $perawatanLuka->links() }}
        </div>
        @include('sweetalert::alert')
    </div>
@endsection
