@extends('admin.layouts.main')

@section('container')

    
    <div class="pagetitle">
        <h1>Perawat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel Perawat</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table Perawat</h5><br>
            <div class="card-tools">
               <a href="/dokter/create" class="btn btn-success"><i class="fas fa-plus-square"></i> Tambah Data</a>
            </div>
           <form action="{{ url('/dokter') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search"  class="form-control rounded-pill" placeholder="Search by Name" value="{{ $search }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"class="text-center">No</th>
                        <th scope="col"class="text-center">Nama Perawat</th>
                        <th scope="col"class="text-center">Avatar</th>
                        <th scope="col"class="text-center">Jenis Kelamin</th>
                        <th scope="col"class="text-center">Umur</th>
                        <th scope="col"class="text-center">No HP</th>
                        <th scope="col"class="text-center">Email</th>
                        <th colspan="2" scope="col"class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @php
                    dd($dokters->items);
                @endphp --}}

                    @foreach ($dokters as $dokter)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $dokter->nama_dokter }}</td>
                        <td class="text-center">
                            @if ($dokter->gambar_dokter)
                                <img id="myImg"
                                src="{{ url('img') . '/' . $dokter->gambar_dokter }}"
                                alt="{{ $dokter->gambar_dokter }}" class="rounded-circle" width="60px" height="60px" >
                            @endif
                        </td>
                        <td class="text-center">{{ $dokter->jenis_kelamin }}</td>
                        <td class="text-center">{{ $dokter->umur }}</td>
                        <td class="text-center">{{ $dokter->no_hp }}</td>
                        <td class="text-center">{{ $dokter->email }}</td>
                        <td class="text-center">
                           <a href="/dokter/{{ $dokter->id }}/edit" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <form action="/dokter/{{ $dokter->id }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit" title="Delete">
                                <i class="fas fa-trash-alt"></i> 
                            </button>
                        </form>
                            
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                
            </table>
            </div>
            <div>
         {{ $dokters->links() }}
        </div>
        </div>
@include('sweetalert::alert')
        @endsection