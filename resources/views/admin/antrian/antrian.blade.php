@extends('admin.front.main')

@section('container')
<!DOCTYPE html>
<html>
<head>
    <title>Antrian</title>
    <style>
        .button-container {
            display: flex;
            justify-content: center; /* Menyamakan tombol ke tengah */
            margin-top: 20px;
        }

        .button-container form {
            margin: 0 10px; /* Mengatur jarak horizontal antara tombol */
            display: inline-block;
        }
    </style>
</head>
<body>
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <p class="text-center">No Antrian Terakhir: {{ $antrianHariIni }}</p>

    <div class="button-container">
        @if ($penggunaSudahMengambilAntrian)
            <button class="btn btn-primary" disabled>Ambil Antrian</button>
        @else
            <form method="POST" action="{{ route('ambil-antrian') }}">
                @csrf
                <button class="btn btn-primary" type="submit">Ambil Antrian</button>
            </form>
        @endif

        <form method="POST" action="{{ route('cetak') }}">
            @csrf
            <button class="btn btn-primary" type="submit">Cetak No Antrian</button>
        </form>
        <a href="/halaman-awal" class="btn btn-danger"></i> Kembali</a>
    </div>
   

</body>

</html>
@endsection
