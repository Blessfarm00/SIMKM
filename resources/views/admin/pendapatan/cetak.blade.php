<!DOCTYPE html>
<html>

<head>
    <title>Cetak Semua Data Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            display: none;
            /* Sembunyikan tombol cetak saat mencetak */
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media print {
            button {
                display: block;
            }

            body {
                background-color: #fff;
            }
        }
    </style>
</head>

<body>
    <h1>Semua Data Pendapatan</h1>

    <table>
        <thead>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"class="text-center">No</th>
                        <th scope="col"class="text-center">Kode Pendapatan</th>
                        <th scope="col"class="text-center">Kode Rekam Medis</th>
                        <th scope="col"class="text-center">Pelayanan</th>
                        <th scope="col"class="text-center">Harga</th>
                        <th scope="col"class="text-center">Kode Resep</th>
                        <th scope="col"class="text-center">Harga Obat</th>
                        <th scope="col"class="text-center">Total</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendapatans as $pendapatan)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $pendapatan->kode_pendapatan }}</td>
                            <td class="text-center">
                                {{ $pendapatan->rekam_medis ? $pendapatan->rekam_medis->kode_rekam_medis : '-' }}</td>
                            <td class="text-center">{{ $pendapatan->pelayanan }}</td>
                            <td class="text-center"> Rp {{ number_format($pendapatan->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                {{ $pendapatan->resep_obat ? $pendapatan->resep_obat->resep_id : '-' }}</td>
                            <td class="text-center"> Rp {{ number_format($pendapatan->harga_obat, 0, ',', '.') }}</td>
                            <td class="text-center"> Rp {{ number_format($pendapatan->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
            <tr>
                    <td colspan="8" class="text-right"><strong>Total Pendapatan:</strong></td>
                    <td class="text-center"><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
                    <td colspan="2"></td>
                </tr>
</body>

</html>
