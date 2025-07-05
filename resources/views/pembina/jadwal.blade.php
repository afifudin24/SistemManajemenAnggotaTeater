@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Jadwal Teater</h4>
                        <button data-bs-toggle="modal" data-bs-target="#contohModal" class="btn btn-primary mt-1 mb-1">Tambah
                            Jadwal</button>
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
                                        <th>Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>

                                        <th>Lokasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwal as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kegiatan }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->waktu_mulai }}</td>
                                            <td>{{ $item->waktu_selesai }}</td>
                                            <td>{{ $item->lokasi }}</td>
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
                                            <td colspan="7" class="text-center text-muted">Belum Ada Data Jadwal</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                            <div class="mt-5 d-flex justify-content-end">
                                {{ $jadwal->links() }}

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
                    <h5 class="modal-title" data id="contohModalLabel">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    {{-- form tambah bendahara --}}
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan"
                                required>
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal"
                                required>
                            <label for="tanggal" class="form-label">Tanggal</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai"
                                placeholder="Waktu Mulai" required>
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai"
                                placeholder="Waktu Selesai" required>
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi"
                                required>
                            <label for="lokasi" class="form-label">Lokasi</label>
                        </div>

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

    {{-- Modal Edit Jadwal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="contohModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="contohModalLabel">Edit Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    {{-- form tambah Bendahara --}}
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                       <div class="form-floating mb-3">
      <input type="text" class="form-control" name="kegiatan" id="kegiatan_edit" placeholder="Kegiatan" required>
      <label for="kegiatan_edit" class="form-label">Kegiatan</label>
    </div>

    <div class="form-floating mb-3">
      <input type="date" class="form-control" name="tanggal" id="tanggal_edit" placeholder="Tanggal" required>
      <label for="tanggal_edit" class="form-label">Tanggal</label>
    </div>

    <div class="form-floating mb-3">
      <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai_edit" placeholder="Waktu Mulai" required>
      <label for="waktu_mulai_edit" class="form-label">Waktu Mulai</label>
    </div>

    <div class="form-floating mb-3">
      <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai_edit" placeholder="Waktu Selesai" required>
      <label for="waktu_selesai_edit" class="form-label">Waktu Selesai</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="lokasi" id="lokasi_edit" placeholder="Lokasi" required>
      <label for="lokasi_edit" class="form-label">Lokasi</label>
    </div>

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
            console.log("oke");

            $('.btnEdit').click(function() {
                let item = $(this).data('item');
                console.log(item);
                $('#kegiatan_edit').val(item.kegiatan);

                $('#tanggal_edit').val(item.tanggal);
                $('#waktu_mulai_edit').val(item.waktu_mulai);
                $('#waktu_selesai_edit').val(item.waktu_selesai);
                $('#lokasi_edit').val(item.lokasi);
                $('#editForm').attr('action', `/updatejadwal/${item.id_jadwal}`);
            })

            $('.btnHapus').click(function() {
                let item = $(this).data('item');
                console.log(item)
                $('#formHapus').attr('action', `/hapusjadwal/${item.id_jadwal}`);
            });
        </script>
    @endpush

@endsection
