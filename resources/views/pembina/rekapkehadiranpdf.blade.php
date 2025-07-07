<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Kehadiran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .bg-success {
            background-color: #c6efce;
        }
        .bg-warning {
            background-color: #fff2cc;
        }
        .bg-info {
            background-color: #ddebf7;
        }
        .bg-danger {
            background-color: #f8cbad;
        }
        h3 {
            text-align: center;
            margin-bottom: 0;
        }
        .subtitle {
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>

<h3>Rekap Kehadiran Anggota</h3>
<p class="subtitle">Bulan {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</p>

@php
    $tanggalList = $kehadiran->pluck('tanggal_pencatatan')->unique()->sort()->values();
    $kehadiranPerAnggota = $kehadiran->groupBy('id_anggota');
@endphp

@if($kehadiran->isEmpty())
    <p style="text-align:center; margin-top: 50px;">Belum ada data kehadiran untuk bulan ini.</p>
@else
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            @foreach($tanggalList as $tgl)
                <th>{{ \Carbon\Carbon::parse($tgl)->format('d') }}</th>
            @endforeach
            <th class="bg-success">TH</th>
            <th class="bg-warning">TI</th>
            <th class="bg-info">TS</th>
            <th class="bg-danger">TA</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($kehadiranPerAnggota as $idAnggota => $dataAnggota)
            @php
                $totalH = $totalI = $totalS = $totalA = 0;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dataAnggota->first()->anggota->nama ?? '-' }}</td>
                @foreach($tanggalList as $tgl)
                @php
    $kehadiranHariItu = $dataAnggota->firstWhere('tanggal_pencatatan', $tgl);
    $status = $kehadiranHariItu->status_kehadiran ?? '-';
    $short = strtoupper(substr($status, 0, 1));

    if ($short === 'H') $totalH++;
    elseif ($short === 'I') $totalI++;
    elseif ($short === 'S') $totalS++;
    elseif ($short === 'A') $totalA++;
@endphp
<td>{{ $kehadiranHariItu ? $short : '-' }}</td>
                @endforeach
                <td class="bg-success">{{ $totalH }}</td>
                <td class="bg-warning">{{ $totalI }}</td>
                <td class="bg-info">{{ $totalS }}</td>
                <td class="bg-danger">{{ $totalA }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

</body>
</html>
