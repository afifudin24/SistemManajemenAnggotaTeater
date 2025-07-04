@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Anggota</h4>
                    {{-- <p class="card-description"> Add class <code>.table</code> --}}

                   <button data-bs-toggle="modal" data-bs-target="#contohModal" class="btn btn-primary mt-1 mb-1">Tambah
                            Anggota</button>
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
                            <th>Nama</th>
                            <th>Username</th>
                          
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($anggota as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->username }}</td>
                            <td>@if ($item->status == 1) Aktif @else Tidak Aktif @endif</td>
                            <td>
                              <button data-bs-toggle="modal" data-bs-target="#editModal" data-user='@json($item)' class="btn btnEdit btn-primary">Edit</button>
                              <button data-bs-toggle="modal" data-bs-target="#hapusModal" data-user='@json($item)' class="btn btnHapus btn-danger">Hapus</button>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <div class="mt-5 d-flex justify-content-end">
                          {{ $anggota->links() }}

                      </div>
                    </div>
                  </div>
                </div>
              </div>
           
            </div>
          </div>

             <!-- Modal tambah Pembina -->
    <div class="modal fade" id="contohModal" tabindex="-1" aria-labelledby="contohModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" data id="contohModalLabel">Tambah Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    {{-- form tambah Pembina --}}
                    <form action="{{ route('anggota.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Nama Pembina" required>
                            <label for="nama" class="form-label">Nama Anggota</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nis" id="nis"
                                placeholder="NIS" required>
                            <label for="nama" class="form-label">NIS</label>
                        </div>
                     
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                                required>
                            <label for="username" class="form-label">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                           <div class="form-floating mb-3">

                            <select class="form-select" name="kelas" id="status">
                              <option value="" selected disabled>Kelas</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>

                        </div>
                          <div class="form-floating mb-3">

                            <select class="form-select" name="id_pembina" id="id_pembina">
                              <option value="" selected disabled>Pembina</option>
                              @foreach ($pembina as $item)
                                <option value="{{ $item->id_pembina }}">{{ $item->nama }}</option>
                              @endforeach  
                            
                            </select>

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

    {{-- Modal Edit Pembina --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="contohModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="contohModalLabel">Edit Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    {{-- form tambah Pembina --}}
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" id="nama_edit"
                                placeholder="Nama Anggota" required>
                            <label for="nama_edit" class="form-label">Nama Anggota</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nis" id="nis_edit"
                                placeholder="NIS" required>
                            <label for="nis_edit" class="form-label">NIS</label>
                        </div>
                       
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="username_edit"
                                placeholder="Username" required>
                            <label for="username_edit" class="form-label">Username</label>
                        </div>
                           <div class="form-floating mb-3">

                            <select class="form-select" name="kelas" id="kelas_edit">
                              <option value="" selected disabled>Kelas</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>

                        </div>
                           <div class="form-floating mb-3">

                            <select class="form-select" name="id_pembina" id="id_pembina_edit">
                              <option value="" selected disabled>Pembina</option>
                                @foreach ($pembina as $item)
                                <option value="{{ $item->id_pembina }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-floating mb-3">

                            <select class="form-select" name="status" id="status_edit">
                              <option value="" selected disabled>Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>

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
                let user = $(this).data('user');
                console.log(user)
                $('#nama_edit').val(user.nama);
                
                $('#nis_edit').val(user.nis);
                $('#username_edit').val(user.username);
                $('#kelas_edit').val(user.kelas);
                $('#id_pembina_edit').val(user.id_pembina);
                $('#status_edit').val(user.status);
                $('#editForm').attr('action', `/updateanggota/${user.id_anggota}`);
            })

            $('.btnHapus').click(function() {
                let user = $(this).data('user');
                console.log(user)
                $('#formHapus').attr('action', `/hapusanggota/${user.id_anggota}`);
            });
        </script>
    @endpush
          
@endsection