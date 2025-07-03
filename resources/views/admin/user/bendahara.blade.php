@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Bendahara</h4>
                    {{-- <p class="card-description"> Add class <code>.table</code> --}}

                    {{-- </p> --}}
                    <button class="btn btn-primary mt-1 mb-1">Tambah Bendahara</button>
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
                        @foreach ($bendahara as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
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
                          {{ $bendahara->links() }}

                      </div>
                    </div>
                  </div>
                </div>
              </div>
           
            </div>
          </div>
          
@endsection