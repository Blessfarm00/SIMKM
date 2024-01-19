@extends('admin.layouts.main')


@section('container')

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<div class="pagetitle">
    <h1>User</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tabel User</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-header text-center">Table User</h5><br>
        <div class="card-tools">
            <a href="/user/create" class="btn btn-success"><i class="fas fa-plus-square"></i> Tambah Data</a>
        </div>
        <form action="{{ url('/user') }}" method="GET">
            <div class="input-group mt-4">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="Nama User" value="{{ $search }}">
                <button class="btn btn-primary rounded-pill" type="submit">Search</button>
            </div>
        </form>
        <hr>
        <div class="table-responsive"> <!-- Wrap the table in a responsive container -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Avatar</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">No HP</th>
                        <th scope="col" class="text-center">Posisi</th>
                        <th scope="col" class="text-center">Role</th>
                        <th colspan="2" scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center"><img class="rounded-circle" width="60px" height="60px" src="{{ asset('img/'.$user->gambar_user) }}" alt=""></td>
                            <td class="text-center">{{ $user->email }}</td>
                            {{-- <td>{{ $user->avatar }}</td> --}}
                            <td class="text-center">0{{ $user->no_hp }}</td>
                            <td class="text-center">{{ $user->posisi }}</td>
                            <td class="text-center">{{ $user->role }}</td>
                            <td class="text-center">
                                <a href="/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm inline-block"><i class="fas fa-pen-to-square"></i></a>
                                <form action="/user/{{ $user->id }}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Akan Menghapus Data..?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection
