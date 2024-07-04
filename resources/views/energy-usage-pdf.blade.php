<!DOCTYPE html>
<html>
<head>
    <title>Energy Usage Report - Gedung {{ $gedung }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Energy Usage Report - Gedung {{ $gedung }}</h1>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Energy Usage (kWh)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $data)
                <tr>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->kwh }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
