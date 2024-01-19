<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kedai Kopi Rona</title>
{{-- 
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                    </h2>           
                </div>

                <div class="col-12">
                    <h2 class="page-header" style="text-align: center;">
                        <i class="center"></i> KEDAI KOPI RONA
                    </h2>
                </div>


                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Admin</strong><br>
                        Jl. Rasuna Said No.81 C-1, Ujung Gurun, <br>
                        Kec. Padang Bar., Kota Padang, Sumatera Barat<br>
                        Phone: (804) 123-5432<br><br>
                    </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                       <table class="table table-striped">
                <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Nama</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">No HP</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Nama Dokter</th>
                            <th scope="col" class="text-center">Jam(WIB)</th>
                            <th scope="col" class="text-center">Tanggal</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">Options</th>
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
                        <td class="text-center">{{$janji->alamat}}</td>
                        <td class="text-center">{{$janji->no_hp}}</td>
                        <td class="text-center">{{$janji->email}}</td>
                        <td class="text-center">{{$janji->dokter ? $janji->dokter->nama_dokter : '-'  }}</td>
                        <td class="text-center">{{ $janji->jam}} WIB</td>
                        <td class="text-center">{{ $janji->tanggal}}</td>
                        <td class="text-center">{{ $janji->keterangan }}</td>
                    </tr>
                    @endforeach

                </tbody>

            </table>

                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>

        
 