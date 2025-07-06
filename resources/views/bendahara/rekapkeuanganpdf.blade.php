<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Keuangan</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 12px; }
    </style>
</head>
<body>
    <h2>Rekap Keuangan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keuangan as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ ucfirst($item->jenis) }}</td>
                <td>{{ 'Rp' . number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
