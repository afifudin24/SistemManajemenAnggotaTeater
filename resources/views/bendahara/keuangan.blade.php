@extends('layouts.dashboard')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Keuangan</h4>
                        <button data-bs-toggle="modal" data-bs-target="#contohModal" class="btn btn-primary mt-1 mb-1">Tambah
                            Keuangan</button>
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
                                        <th>Aksi</th>
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


                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-item='@json($item)'
                                                    class="btn btnEdit btn-primary">Edit</button>
                                                <button data-bs-toggle="modal" data-bs-target="#hapusModal"
                                                    data-item='@json($item)'
                                                    class="btn btnHapus btn-danger">Hapus</button>
                                            </td>
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

    <!-- Modal tambah jadwal -->
    <div class="modal fade" id="contohModal" tabindex="-1" aria-labelledby="contohModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" data id="contohModalLabel">Tambah Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    {{-- form tambah keuangan --}}
                    <form action="{{ route('keuangan.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah"
                                required>
                            <label for="jumlah" class="form-label">Jumlah</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal"
                                required>
                            <label for="tanggal" class="form-label">Tanggal</label>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Jenis</label>
                           <select class="form-select text-dark" name="jenis" id="jenis">
                            <option value="" disabled selected>Jenis Pemasukan</option>
                               <option class="text-dark" value="pemasukan">Pemasukan</option>
                               <option class="text-dark" value="pengeluaran">Pengeluaran</option>
                           </select>
                        </div>
                        <div class="">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" col="30" rows="10"></textarea>
                        </div>
                        <!-- bukti -->
                        <div class="form-floating mb-3"></div>

                        <label for="bukti" class="form-label">Bukti</label>
                            <input type="file" class="form-control" name="bukti" id="bukti" placeholder="Bukti" required>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Modal Edit Keuangan --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editKeuanganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="editKeuanganLabel">Edit Data Keuangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form id="editForm" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-floating mb-3">
            <input type="number" class="form-control" name="jumlah" id="jumlah_edit" placeholder="Jumlah" required>
            <label for="jumlah_edit" class="form-label">Jumlah</label>
          </div>

          <div class="form-floating mb-3">
            <input type="date" class="form-control" name="tanggal" id="tanggal_edit" placeholder="Tanggal" required>
            <label for="tanggal_edit" class="form-label">Tanggal</label>
          </div>

          <div class="mb-3">
              <label for="jenis_edit" class="form-label">Jenis Transaksi</label>
            <select class="form-select text-dark" name="jenis" id="jenis_edit" required>
              <option value="" disabled selected>Pilih Jenis Transaksi</option>
              <option class="text-dark" value="pemasukan">Pemasukan</option>
              <option class="text-dark" value="pengeluaran">Pengeluaran</option>
            </select>
          </div>

          <div class="mb-3">
              <label for="keterangan_edit" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan_edit" class="form-control" placeholder="Keterangan" style="height: 100px;"></textarea>
          </div>
            <div class="mb-3">
                <img class="img-thumbnail w-25" src="" id="bukti_preview" alt="">
            </div>
          <div class=" mb-3">
            <label for="bukti_edit" class="form-label">Bukti Transaksi (opsional, isi jika ingin mengganti)</label>
            <input type="file" class="form-control" name="bukti" id="bukti_edit" accept="image/*">
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


    {{-- modal hapus Pembina --}}
    <!-- Modal -->
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
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
