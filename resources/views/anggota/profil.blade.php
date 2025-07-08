@extends('layouts.dashboard')
@section('content')
       <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Profil Saya</h3>

                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- kasih alert jika succes dan error jika ada error -->

            <div class="row">
              <div class="col-md-6 col-12 p-3 card">
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
                 <form id="formUpdateUser" action="/updateprofilanggota" method="POST">
                @csrf
                <div class="row">
                  <div class="col-6">
                       <div class="form-floating mb-3">
                       <input type="text" class="form-control" name="nama" value="{{session('user')->nama}}" id="nama"
                                placeholder="Nama" required>
                            <label for="nama" class="form-label">Nama</label>
               </div>
                <div class="form-floating mb-3">
                       <input type="text" class="form-control" name="username" value="{{session('user')->username}}" id="nama"
                                placeholder="Username" required>
                            <label for="username" class="form-label">Username</label>
               </div>
                  </div>
               <div class="col-6">

              <div>
  <button type="button" id="tombolGantiPassword" class="btn btn-primary" onclick="tampilkanInputPassword()">Ganti Password</button>
</div>

<!-- Input Password, disembunyikan awalnya -->
<div class="form-floating mb-3" id="inputPasswordContainer" style="display: none;">
  <input type="password" class="form-control" name="password" id="password"
         placeholder="Klik untuk ganti password">
  <label for="password" class="form-label">Password</label>
</div>
               </div>
               <div>
                   <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
                  </div>



            </form>
              </div>

            </div>

            <div class="modal fade" id="gantiPasswordModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Edit Password</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        Apakah yakin mengganti password?
      </div>
      <div class="modal-footer justify-content-center">
      <button class="btn btn-primary" id="gantiPasswordbtn">Yakin</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>



          {{-- </div> --}}

        </div>

        @push('scripts')
    <!-- Script -->
<script>
  function tampilkanInputPassword() {
    const inputContainer = document.getElementById('inputPasswordContainer');
    const tombolGantiPassword = document.getElementById('tombolGantiPassword');
    inputContainer.style.display = 'block';
    tombolGantiPassword.style.display = 'none';
  }
</script>

        @endpush


@endsection
