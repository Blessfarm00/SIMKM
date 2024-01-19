@extends('admin.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Obat</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tabel Obat</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-header text-center">Table obat</h5><br>
           @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
                  @else
                    <div class="card-tools">
                        <a href="/obat/create" class="btn btn-success"> <i class="fas fa-plus-square"></i> Tambah Data</a>  
                    </div>
                 @endif
        <form action="{{ url('/obat') }}" method="GET">
            <div class="input-group mt-4">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Name" value="{{ $search }}">
                <div class="input-group-append">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </div>
        </form>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama Obat</th>
                    <th scope="col" class="text-center">Jenis Obat</th>
                    <th scope="col" class="text-center">Merek Obat</th>
                    <th scope="col" class="text-center">Masa Berlaku</th>
                    <th scope="col" class="text-center">Stock</th>
                    <th scope="col" class="text-center">Satuan</th>
                    <th scope="col" class="text-center">Harga per Strip</th>
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
                @foreach ($obats as $obat)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $obat->nama_obat }}</td>
                    <td class="text-center">{{ $obat->jenis_obat}}</td>
                    <td class="text-center">{{ $obat->merek_obat }}</td>
                    <td class="text-center">{{ $obat->masa_berlaku }}</td>
                    <td class="text-center">{{ $obat->stock }}</td>
                    <td class="text-center">{{ $obat->satuan }}</td>
                     <td class="text-center"> Rp {{ number_format($obat->harga, 0, ',', '.')}}</td>
                       @php
                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                @endphp

                @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
            @else
                    <td class="text-center">
                        <a href="/obat/{{ $obat->id }}/edit" class="btn btn-primary btn-sm"> <i class="fas fa-pen-to-square"></i></a>
                        <form action="/obat/{{ $obat->id }}" method="post" class="d-inline">
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

        {{ $obats->links() }}
    
    </div>
</div>

@include('sweetalert::alert')

@endsection
