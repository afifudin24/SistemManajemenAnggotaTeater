@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Absen Anggota</h4>
                    
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
                        @if ($jadwal->isEmpty())
  <p>Tidak ada jadwal kegiatan saat ini.</p>
@else
  @if ($kehadiran->isEmpty())
    <p>Belum ada absensi hari ini. Silakan isi kehadiran anggota:</p>

    <form action="{{ route('kehadiran.store') }}" method="POST">
      @csrf
      <div class="col-md-6">
        <input type="hidden" name="id_jadwal" value="{{ $jadwal[0]->id_jadwal }}">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control mb-8" cols="20" rows="5"></textarea>
      </div>
      <table class="table">
        <thead>
   <tr>
  <th>Nama</th>
  <th>
    <span class="d-block d-sm-none">H</span>
    <span class="d-none d-sm-block">Hadir</span>
  </th>
  <th>
    <span class="d-block d-sm-none">S</span>
    <span class="d-none d-sm-block">Sakit</span>
  </th>
  <th>
    <span class="d-block d-sm-none">I</span>
    <span class="d-none d-sm-block">Izin</span>
  </th>
  <th>
    <span class="d-block d-sm-none">A</span>
    <span class="d-none d-sm-block">Alpha</span>
  </th>
</tr>

        </thead>
        <tbody>
          @foreach ($anggota as $a)
            <tr>
              <td>{{ $a->nama }}</td>
              <td><input type="radio" name="kehadiran[{{ $a->id_anggota }}]" checked value="Hadir"></td>
              <td><input type="radio" name="kehadiran[{{ $a->id_anggota }}]" value="Sakit"></td>
              <td><input type="radio" name="kehadiran[{{ $a->id_anggota }}]" value="Izin"></td>
              <td><input type="radio" name="kehadiran[{{ $a->id_anggota }}]" value="Alpha"></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <button type="submit" class="btn mt-5 d-block mx-auto text-center btn-success">Simpan Kehadiran</button>
    </form>
@else
  <p>Data kehadiran untuk tanggal {{ $tanggalHariIni }} sudah tercatat. Anda bisa memperbaruinya di bawah ini:</p>

  <form action="{{ route('kehadiran.update') }}" method="POST">
    @csrf
    @method('PUT')
     <div class="col-md-6">
        {{-- <input type="hidden" name="id_jadwal" value="{{ $jadwal[0]->id_jadwal }}"> --}}
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control mb-8" cols="20" rows="5">{{$kehadiran[0]->catatan}}</textarea>
      </div>
      <div class="table-responsive">

  
    <table class="table table-striped responsive">
      <thead>
 <tr>
  <th>Nama</th>
  <th>
    <span class="d-block d-sm-none">H</span>
    <span class="d-none d-sm-block">Hadir</span>
  </th>
  <th>
    <span class="d-block d-sm-none">S</span>
    <span class="d-none d-sm-block">Sakit</span>
  </th>
  <th>
    <span class="d-block d-sm-none">I</span>
    <span class="d-none d-sm-block">Izin</span>
  </th>
  <th>
    <span class="d-block d-sm-none">A</span>
    <span class="d-none d-sm-block">Alpha</span>
  </th>
</tr>

      </thead>
      <tbody>
        @foreach ($kehadiran as $k)
          <tr>
            <td>{{ $k->anggota->nama }}</td>
            <td>
              <input type="radio" name="kehadiran[{{ $k->id_kehadiran }}]" value="Hadir"
                     {{ $k->status_kehadiran === 'Hadir' ? 'checked' : '' }}>
            </td>
            <td>
              <input type="radio" name="kehadiran[{{ $k->id_kehadiran }}]" value="Sakit"
                     {{ $k->status_kehadiran === 'Sakit' ? 'checked' : '' }}>
            </td>
            <td>
              <input type="radio" name="kehadiran[{{ $k->id_kehadiran }}]" value="Izin"
                     {{ $k->status_kehadiran === 'Izin' ? 'checked' : '' }}>
            </td>
            <td>
              <input type="radio" name="kehadiran[{{ $k->id_kehadiran }}]" value="Alpha"
                     {{ $k->status_kehadiran === 'Alpha' ? 'checked' : '' }}>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
        </div>

    <div class="mt-3 text-center">
      <button type="submit" class="btn mx-auto block text-center btn-warning">Perbarui Kehadiran</button>
    </div>
  </form>
@endif
@endif


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
