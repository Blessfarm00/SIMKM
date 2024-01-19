    @extends('admin.layouts.main')

    @section('container')
        <div class="pagetitle">
            <h1>Pasien</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tabel pasien</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-header text-center">Table pasien</h5><br>
                <div class="card-tools">
                    @php
                        $user = Auth::guard('dokter')->user() ?? Auth::user();
                    @endphp

                    @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
                    @else
                        <a href="/pasien/create" class="btn btn-success"><i class="fas fa-plus-square"></i> Tambah Data</a>
                    @endif
                </div>
                <form action="{{ url('/pasien') }}" method="GET">
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
                                <th scope="col" class="text-center">NIK</th>
                                <th scope="col" class="text-center">Nama Pasien</th>
                                <th scope="col" class="text-center">Jenis Kelamin</th>
                                <th scope="col" class="text-center">Tanggal Lahir</th>
                                <th scope="col" class="text-center">Alamat</th>
                                @php
                                    $user = Auth::guard('dokter')->user() ?? Auth::user();
                                @endphp

                                @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
                                @else
                                    <th scope="col" class="text-center">Options</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasiens as $pasien)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $pasien->nik }}</td>
                                    <td class="text-center">{{ $pasien->nama_pasien }}</td>
                                    <td class="text-center">{{ $pasien->jenis_kelamin }}</td>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($pasien->tgl)) }}</td>
                                    <td class="text-center">{{ $pasien->alamat }}</td>
                                    @php
                                        $user = Auth::guard('dokter')->user() ?? Auth::user();
                                    @endphp

                                    @if ($user = Auth::guard('dokter')->user() ?? $user->role == 'superadmin')
                                    @else
                                        <td class="text-center">
                                            <a href="/pasien/{{ $pasien->id }}/edit"
                                                class="btn btn-primary btn-sm"><i class="fas fa-pen-to-square"></i></a>
                                            <form action="/pasien/{{ $pasien->id }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Akan Menghapus Data..?')"
                                                    type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <a href="/laporan/{{ $pasien->id }}" class="btn btn-success btn-sm"><i class="fa-solid fa-print"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pasiens->links() }}

                <!-- Tampilkan jumlah halaman -->
                {{-- Jumlah Halaman: {{ $pasiens->lastPage() }} --}}

            </div>
            @include('sweetalert::alert')
        @endsection
