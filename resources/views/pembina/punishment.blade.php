@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Punishment</h4>
                        {{-- <form method="GET" action="{{ route('keuangan.index') }}" class="row gy-2 mt-3 gx-2 align-items-end mb-3">
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
</form> --}}
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
                        <div class="table-responsive table-striped">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Karya</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($punishment as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->anggota->nama }}</td>
                                            <td>
                                            @if($item->status_punishment == "Perlu Upload Karya")
                                                <p>Belum Upload Karya</p>
                                            @elseif($item->karya != null && $item->status_punishment == "Menunggu Konfirmasi")
                                            <a href="{{ asset('storage/' . $item->karya) }}" target="_blank" class="btn btn-info">Lihat Karya</a>
                                        
                                            @elseif($item->status_punishment == "Diterima")
                                            <a href="{{ asset('storage/' . $item->karya) }}" target="_blank" class="btn btn-info">Lihat Karya</a>
                                            @elseif($item->status_punishment == "Ditolak")
                                            <a href="{{ asset('storage/' . $item->karya) }}" target="_blank" class="btn btn-info">Lihat Karya</a>
                                            @endif
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $item->status_punishment }}
                                                </p>
                                            <td>
                                                @if($item->status_punishment == "Perlu Upload Karya")
                                                -
                                                @elseif($item->status_punishment == "Menunggu Konfirmasi")
                                                <div class="d-flex gap-2">
                                                    <form action="/updatestatuspunishment/{{ $item->id_punishment }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_punishment" value="Diterima">
                                                        <button type="submit" class="btn btn-primary">Terima</button>
                                                    </form>
                                                     <form action="/updatestatuspunishment/{{ $item->id_punishment }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_punishment" value="Ditolak">
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                </div>
                                                @elseif($item->status_punishment == "Ditolak" || $item->status_punishment == "Diterima")
                                                <form action="/updatestatuspunishment/{{ $item->id_punishment }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_punishment" value="Perlu Upload Karya">
                                                    <button type="submit" class="btn btn-primary">Reset</button>
                                                </form>
                                                @endif
                                            </td>
                                            {{-- <td class="text-capitalize">{{ $item->status_punishment }}</td> --}}
                                           
                                           
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum Ada Data Punishment</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-5 d-flex justify-content-end">
                                {{ $punishment->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- Modal Edit Keuangan --}}
<div class="modal fade" id="karyaModal" tabindex="-1" aria-labelledby="editKeuanganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="editKeuanganLabel">Kirim Karya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <form id="karyaForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="karya" class="form-label">Karya</label>
            <input type="file" class="form-control" name="karya" id="karya" placeholder="Karya" required>
        </div>
     
      
       
    
          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  {{-- modal lihat karya --}}
  <div class="modal fade" id="lihatKaryaModal" tabindex="-1" aria-labelledby="lihatKaryaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="editKeuanganLabel">Lihat Karya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <form id="lihatKaryaForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <a id="linkbukti" href="" target="_blank" class="">Lihat Bukti</a>
        </div>
        <div class="mb-3">
            <label for="karya" class="form-label">Karya (Opsional jika ingin mengganti)</label>
            <input type="file" class="form-control" name="karya" id="karya" placeholder="Karya" required>
        </div>
     
      
       
    
          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
            </form>
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
          
         
            $('.btnHapus').click(function() {
                let item = $(this).data('item');
                console.log(item)
                $('#formHapus').attr('action', `/hapuskeuangan/${item.id_transaksi}`);
            });
            $('#uploadKaryaBtn').click(function() {
                let item = $(this).data('item');
                console.log(item)
                $('#karyaForm').attr('action', `/kirimkarya/${item.id_punishment}`);
            })

            $('#lihatKaryaBtn').click(function() {
                let item = $(this).data('item');
                console.log(item)
                console.log('okeee');
                $('#linkbukti').attr('href', 'storage/' + item.karya);
                  $('#lihatKaryaForm').attr('action', `/kirimkarya/${item.id_punishment}`);
            })
        </script>
    @endpush
@endsection