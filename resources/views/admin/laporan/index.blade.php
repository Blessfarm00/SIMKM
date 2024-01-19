<!DOCTYPE html>
<html>
<head>
    <title>Cetak Semua Data Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Semua Data Pasien</h1>
    
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasiens as $pasien)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pasien->nik }}</td>
                    <td>{{ $pasien->nama_pasien }}</td>
                    <td>{{ $pasien->jenis_kelamin }}</td>
                    <td>{{ date('d/m/Y', strtotime($pasien->tgl)) }}</td>
                    <td>{{ $pasien->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Semua Data Pemeriksaan</h1>
    
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Pemeriksaan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Nama Dokter</th>
                <th scope="col">Tekanan Darah</th>
                <th scope="col">Suhu Badan</th>
                <th scope="col">Keluhan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemeriksaans as $pemeriksaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pemeriksaan->kode_pemeriksaan }}</td>
                    <td>{{ $pemeriksaan->tanggal }}</td>
                    <td>{{ $pemeriksaan->pasien ? $pemeriksaan->pasien->nama_pasien : '-'  }}</td>
                    <td>{{ $pemeriksaan->dokter ? $pemeriksaan->dokter->nama_dokter : '-'  }}</td>
                    <td>{{ $pemeriksaan->tekanan_darah }}</td>
                    <td>{{ $pemeriksaan->suhu_badan }}</td>
                    <td>{{ $pemeriksaan->keluhan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h1>Semua Data Rekam Medis</h1>
    
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Rekam Medis</th>
                <th scope="col">Kode Pemeriksaan</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Diagnosa</th>
                <th scope="col">Tindakan</th>
                <th scope="col">Rujukan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekam_medis as $rm)
                <tr> 
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rm->kode_rekam_medis }}</td>
                    <td>{{ $rm->pemeriksaan ? $rm->pemeriksaan->kode_pemeriksaan : '-' }}</td>
                    <td>{{ $rm->pasien ? $rm->pasien->nama_pasien : '-' }}</td>
                    <td>{{ $rm->diagnosa}}</td>
                    <td>{{ $rm->tindakan}}</td>
                    <td>{{ $rm->rujukan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <button onclick="window.print()">Cetak</button>
    <a href="/pasien" class="btn btn-danger"></i> Kembali</a>
    
</div>
</body>
</html>
