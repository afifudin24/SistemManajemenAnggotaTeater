@extends('layouts.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Absen Saya</h4>
                     
                        
                     {{-- Bulan --}}
                     <form method="GET" action="{{ route('kehadiran.saya') }}" id="form-filter">
<div class="col-sm-2">
    <label for="bulan" class="form-label small mb-1">Bulan</label>
  <select name="bulan" id="bulan" class="form-select text-dark" onchange="document.getElementById('form-filter').submit()">
    @php
        use Carbon\Carbon;
        $selectedBulan = request('bulan') ?? Carbon::now()->format('Y-m');
        for ($i = 0; $i < 12; $i++) {
            $bulan = Carbon::now()->subMonths($i);
            $value = $bulan->format('Y-m');
            $label = $bulan->translatedFormat('F Y');
            $selected = ($value === $selectedBulan) ? 'selected' : '';
            echo "<option value=\"$value\" $selected>$label</option>";
        }
    @endphp
</select>

</div>
                     </form>
                        <div class="table-responsive table-striped">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jadwal</th>
                                        <th>Status Kehadiran</th>
                                        {{-- <th>Jumlah</th>
                                        <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kehadiran as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal_pencatatan }}</td>
                                            <td>{{$item->jadwal->kegiatan}}</td>
                                            <td class="text-capitalize">{{ $item->status_kehadiran }}</td>
                                            
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum Ada Data Kehadiran</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                              

                            </table>
                          
                        </div>
                         
                    </div>
                     <div class="p-4 d-flex gap-px gap-5 justify-content-center">
                                    <h4 class="badge badge-solid badge-success">Total Hadir : {{ $totalhadir }}</h4>
                                    <h4 class="badge badge-warning">Total Izin : {{ $totalizin }}</h4>
                                    <h4 class="badge badge-info">Total Sakit : {{ $totalsakit }}</h4>
                                    <h4 class="badge badge-danger">Total Alpha : {{ $totalalpa}}</h4>
                                </div>
                </div>
            </div>

        </div>
    </div>




  
    @push('scripts')
        <script>
            function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
}

            $('.btnEdit').click(function() {
                let item = $(this).data('item');
                console.log(item);
             $('#jumlah_edit').html(formatRupiah(item.jumlah));
                $('#tanggal_edit').html(item.tanggal);
                $('#jenis_edit').html(item.jenis);
                $('#keterangan_edit').html(item.keterangan);
                $('#bukti_preview').attr('src', 'storage/' + item.bukti_transaksi);
             

            })

            $('.btnHapus').click(function() {
                let item = $(this).data('item');
                console.log(item)
                $('#formHapus').attr('action', `/hapuskeuangan/${item.id_transaksi}`);
            });
        </script>
    @endpush

@endsection
