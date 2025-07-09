@extends('layouts.dashboard')
@section('content')
       <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Selamat datang, {{ session('user')->nama }}</h3>
                    @if($punishment > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  Kamu memiliki punishment. Segera upload karya!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
      
                    @endif
                   
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
           
              <div class="col-md-12 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Pembina</p>
                        <p class="fs-30 mb-2">{{$pembina->nama}}</p>
                      
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Jadwal Teater</p>
                        <p class="fs-30 mb-2">{{$totalJadwal}}</p>
                      
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Jumlah Punishment</p>
                        <p class="fs-30 mb-2">{{$totalPunishment}}</p>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Kehadiran Bulan Ini</p>
                        <p class="fs-30 mb-2">{{$totalKehadiranBulanIni}}</p>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          
          {{-- </div> --}}
       
        </div>
        
          
@endsection