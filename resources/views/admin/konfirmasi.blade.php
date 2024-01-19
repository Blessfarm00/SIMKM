<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Janji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Konfirmasi Janji Anda</h1>
        <p>Terima kasih atas janji Anda untuk perawatan medis.</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Janji</th>
                    <th>Jam (WIB)</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Nama Perawat</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Alasan Penolakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($janjis as $janji)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $janji->nama }}</td>
                    <td>{{ date('d-m-Y', strtotime($janji->tanggal)) }}</td>
                    <td>{{ $janji->jam }} WIB</td>
                    <td>{{ $janji->alamat }}</td>
                    <td>{{ $janji->no_hp }}</td>
                    <td>{{ $janji->dokter ? $janji->dokter->nama_dokter : '-' }}</td>
                    <td>{{ $janji->keterangan }}</td>
                    <td>{{ $janji->status }}</td>
                    <td>{{ $janji->alasan_penolakan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Pastikan Anda memiliki semua informasi ini saat Anda datang untuk janji medis Anda. Jika ada
            pertanyaan atau perubahan yang perlu dibuat, silakan hubungi kami.</p>

        <p>Terima kasih atas kepercayaan Anda kepada kami. Kami siap memberikan pelayanan terbaik untuk Anda.</p>

        <a href="/dashboard-pasien" class="btn">Kembali</a>
    </div>
</body>

</html>
