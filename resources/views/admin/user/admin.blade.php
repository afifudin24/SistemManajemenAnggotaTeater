@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Admin</h4>
                    {{-- <p class="card-description"> Add class <code>.table</code> --}}

                    {{-- </p> --}}
                    <button class="btn btn-primary mt-1 mb-1" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contohModal">Tambah Admin</button>
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
                        @foreach ($admin as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->admin_name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>@if ($item->status == 1) Aktif @else Tidak Aktif @endif</td>
                            <td>
                              <button class="btn btn-primary">Edit</button>
                              <button class="btn btn-danger">Hapus</button>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <div class="mt-5 d-flex justify-content-end">
                          {{ $admin->links() }}

                      </div>
                    </div>
                  </div>
                </div>
              </div>
           
            </div>
          </div>

          <!-- Modal tambah admin -->
<div class="modal fade" id="contohModal" tabindex="-1" aria-labelledby="contohModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="contohModalLabel">Tambah Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        {{-- form tambah admin --}}
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Nama Admin" required>
                <label for="admin_name" class="form-label">Nama Admin</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                <label for="username" class="form-label">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password" class="form-label">Password</label>
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
          @push('script')
          @endpush
          
@endsection