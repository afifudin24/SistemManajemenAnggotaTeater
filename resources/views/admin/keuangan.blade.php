@extends('layouts.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Keuangan</h4>

                        <form method="GET" action="{{ route('keuangan.index') }}" class="row gy-2 mt-3 gx-2 align-items-end mb-3">
                        <div class="col-sm-1">
        <label for="jenis" class="form-label small mb-1">Jenis</label>
        <select name="jenis" id="jenis" class="form-select text-dark">
            <option value="">Semua</option>
            <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
        </select>
    </div>
    <div class="col-sm-2">
        <label for="tanggal_mulai" class="form-label small mb-1">Mulai</label>
        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control form-control-sm"
               value="{{ request('tanggal_mulai') }}">
    </div>
    <div class="col-sm-2">
        <label for="tanggal_akhir" class="form-label small mb-1">Akhir</label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control form-control-sm"
               value="{{ request('tanggal_akhir') }}">
    </div>

    <div class="col-sm-1 d-flex gap-1">
        <button type="submit" class="btn  btn-primary">Filter</button>
        <a href="{{ route('keuangan.index') }}" class="btn  btn-secondary">Reset</a>
    </div>
</form>
                        <div class="table-responsive table-striped">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bendahara</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($keuangan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->bendahara->nama }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td class="text-capitalize">{{ $item->jenis }}</td>
                                            <td>{{ formatRupiah($item->jumlah) }}</td>



                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum Ada Data Keuangan</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                            <div class="mt-5 d-flex justify-content-end">
                                {{ $keuangan->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @push('scripts')
        <script>
            $('.btnEdit').click(function() {
                let item = $(this).data('item');
                console.log(item);
                $('#jumlah_edit').val(item.jumlah);
                $('#tanggal_edit').val(item.tanggal);
                $('#jenis_edit').val(item.jenis);
                $('#keterangan_edit').val(item.keterangan);
                $('#bukti_preview').attr('src', 'storage/' + item.bukti_transaksi);
                $('#editForm').attr('action', `/updatekeuangan/${item.id_transaksi}`);

            })

            $('.btnHapus').click(function() {
                let item = $(this).data('item');
                console.log(item)
                $('#formHapus').attr('action', `/hapuskeuangan/${item.id_transaksi}`);
            });
        </script>
    @endpush

@endsection
