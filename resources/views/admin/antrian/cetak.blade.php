<!DOCTYPE html>
<html>

<head>
    <title>Cetak No Antrian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            max-width: 100%;
            width: 80%; /* Set the table width to 80% of the viewport */
            border-collapse: collapse;
            margin: 0 auto 20px; /* Center-align the table and add a margin at the bottom */
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
                display: none;
            }

            body {
                background-color: #fff;
                display: block;
                min-height: auto;
            }

            table {
                width: 100%; /* Expand the table to full width for printing */
                margin: 0; /* Remove margin for printing */
            }
        }
    </style>
</head>

<body>
    <h1>Data Antrian</h1>

    <table>
        <thead>
            <tr>
                <th>No Antrian</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($antrians as $antrian)
            <tr>
                <td>{{ $antrian->nomor }}</td>
                <td>{{ $antrian->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y') }}</td>
            </tr>
            @break
            @endforeach
        </tbody>
    </table>

     <div style="text-align: center; margin: 20px;">
        <button onclick="window.print()">Cetak</button>
    </div>
</body>

</html>
