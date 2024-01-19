@extends('admin.layouts2.main')

@section('container')
    
    <div class="pagetitle">
        <h1>janji</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Tabel janji</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-header text-center">Table janji</h5><br>
            
            {{-- <form action="{{ url('/janji') }}" method="GET">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control rounded-pill" placeholder="Search by Kode janji " value="{{ $search }}">
                    <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                </div>
            </form> --}}
            <hr>
            <div class="card mx-4">
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Nama</th>
                             <th scope="col" class="text-center">Tanggal janji</th>
                             <th scope="col" class="text-center">Jam(WIB)</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">No HP</th>
                            <th scope="col" class="text-center">Nama Perawat</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">Status</th> 
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

                    @foreach ($janjis as $janji)
                    <tr>
                       {{-- @php
                            dd($rm);
                        @endphp --}}
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $janji->nama }}</td>
                        <td class="text-center">{{date('d-m-Y', strtotime($janji->tanggal))}}</td>
                        <td class="text-center">{{ $janji->jam}} WIB</td>
                        <td class="text-center">{{$janji->alamat}}</td>
                        <td class="text-center">{{$janji->no_hp}}</td>
                        <td class="text-center">{{$janji->dokter ? $janji->dokter->nama_dokter : '-'  }}</td>
                        <td class="text-center">{{ $janji->keterangan }}</td>
                        <td class="text-center">{{ $janji->status }}</td>
            @php
                $user = Auth::guard('dokter')->user() ?? Auth::user();
            @endphp

            @if ($user = Auth::guard('dokter')->user() ??($user->role == 'superadmin'))
        @else
                        <td class="text-center">
            
                            <form action="/janji/{{ $janji->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>

                            <form action="/janji/{{ $janji->id }}/terima" method="post" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Anda yakin ingin menandai sebagai Diterima?')" type="submit"><i class="fas fa-check"></i></button>
                            </form>
                            <form action="/janji/{{ $janji->id }}/tidak-terima" method="post" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menandai sebagai Tidak Diterima?')" type="submit"><i class="fas fa-times"></i></button>
                            </form>
                        </td>
                    @endif
                        
                    </tr>
                    @endforeach

                </tbody>
            </div>
            </div>
            </table>
            {{ $janjis->links() }}
        </div>
        </div>
@include('sweetalert::alert')
        @endsection