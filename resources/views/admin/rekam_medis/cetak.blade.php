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
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            display: none; /* Sembunyikan tombol cetak saat mencetak */
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
    <h1>Semua Data Rekam Medis</h1>
    
    <table>
        <thead>
           <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Kode Rekam Medis</th>
                <th scope="col" class="text-center">Kode Pemeriksaan</th>
                <th scope="col" class="text-center">Nama Pasien</th>
                <th scope="col" class="text-center">Diagnosa</th>
                <th scope="col" class="text-center">Tindakan</th>
                <th scope="col" class="text-center">Rujukan</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($rekam_medis as $rm)
                <tr> 
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $rm->kode_rekam_medis }}</td>
                    <td class="text-center">{{ $rm->pemeriksaan ? $rm->pemeriksaan->kode_pemeriksaan : '-' }}</td>
                     <td class="text-center">{{ $rm->pasien ? $rm->pasien->nama_pasien : '-' }}</td>
                    <td class="text-center">{{ $rm->diagnosa}}</td>
                    <td class="text-center">{{ $rm->tindakan}}</td>
                    <td class="text-center">{{ $rm->rujukan}}</td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
