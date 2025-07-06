@extends('layouts.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Rekap Keuangan</h4>

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="GET" action="{{ route('keuangan.index') }}" class="row gy-2 mt-3 gx-2 align-items-end mb-3">
    <div class="col-sm-2">
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

    <div class="col-sm-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            Filter
        </button>
        <a href="{{ route('keuangan.index') }}" class="btn btn-secondary">
            Reset
        </a>
        <a href="{{ route('keuangan.cetakPDF', request()->all()) }}" target="_blank" class="btn  btn-success">
            Cetak PDF
        </a>
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






@endsection
