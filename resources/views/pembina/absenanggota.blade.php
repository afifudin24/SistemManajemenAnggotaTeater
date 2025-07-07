@extends('layouts.dashboard')
@section('content')
@php
    use Carbon\Carbon;

    $tanggalList = $kehadiran->pluck('tanggal_pencatatan')->unique()->sort()->values();

    // Kelompokkan kehadiran berdasarkan id_anggota
    $kehadiranPerAnggota = $kehadiran->groupBy('id_anggota');

    $selectedBulan = request('bulan') ?? Carbon::now()->format('Y-m');
@endphp

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Absen Anggota</h4>

                    {{-- Bulan Filter --}}
                    <form method="GET" action="{{ route('kehadiran.rekap') }}" id="form-filter" class="d-flex align-items-end  flex-wrap">
    <div>
        <label for="bulan" class="form-label small mb-1">Bulan</label>
        <select name="bulan" id="bulan" class="form-select text-dark" onchange="document.getElementById('form-filter').submit()">
            @for ($i = 0; $i < 12; $i++)
                @php
                    $bulan = Carbon::now()->subMonths($i);
                    $value = $bulan->format('Y-m');
                    $label = $bulan->translatedFormat('F Y');
                    $selected = ($value === $selectedBulan) ? 'selected' : '';
                @endphp
                <option value="{{ $value }}" {{ $selected }}>{{ $label }}</option>
            @endfor
        </select>
    </div>

    <div>
        <label class="form-label small mb-1 invisible">Cetak</label>
        <a href="{{ route('kehadiran.rekap.pdf', ['bulan' => $selectedBulan]) }}" target="_blank" class="btn btn-danger">
            <i class="mdi mdi-file-pdf"></i> Rekap PDF
        </a>
    </div>
</form>


                    @if($kehadiran->isEmpty())
                        <div class="alert alert-warning mt-4">
                            Belum ada data kehadiran untuk bulan ini.
                        </div>
                    @else
                        <div class="table-responsive  mt-3 table-striped">
                            <table class="table ">
                                <thead class=" table">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach($tanggalList as $tgl)
                                            <th>{{ Carbon::parse($tgl)->format('d') }}</th>
                                        @endforeach
                                        <th class="bg-success">TH</th> <!-- Total Hadir -->
                                        <th class="bg-warning">TI</th> <!-- Izin -->
                                        <th class="bg-info">TS</th> <!-- Sakit -->
                                        <th class="bg-danger">TA</th> <!-- Alpa -->
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
                                            <td class="bg-danger"> {{ $totalA }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
