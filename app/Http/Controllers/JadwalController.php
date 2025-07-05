<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use Illuminate\Http\Request;

class JadwalController extends Controller {

    public function getJadwal() {
        $user = session()->get( 'user' );
        $role = session()->get( 'role' );
        $jadwal = Jadwal::with( 'pembina' )->where( 'id_pembina', $user->id_pembina )->paginate( 5 );
        if ( $role == 'pembina' ) {
            $view = 'pembina.jadwal';
        } else {
            $view = 'anggota.jadwal';
        }
        return view( $view, compact( 'jadwal' ) );
    }

    public function tambahJadwal( Request $request ) {
        $user = session()->get( 'user' );
        $cekjadwal = Jadwal::where( 'tanggal', $request->tanggal )->where( 'id_pembina', $user->id_pembina )->first();
        if ( $cekjadwal ) {
            return redirect()->back()->with( 'error', 'Jadwal sudah ada.' );
        }
        $request->validate( [

            'kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
        ], [

            'kegiatan.required' => 'Kegiatan tidak boleh kosong.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'lokasi.required' => 'Lokasi tidak boleh kosong.',
        ] );

        $jadwal = new Jadwal();
        $jadwal->id_pembina = $user->id_pembina;
        $jadwal->kegiatan = $request->kegiatan;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal->lokasi = $request->lokasi;

        $jadwal->save();

        return redirect()->back()->with( 'success', 'Jadwal berhasil ditambahkan.' );
    }

    public function updateJadwal( Request $request, $id ) {
        $user = session()->get( 'user' );
        $request->validate( [

            'kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
        ], [

            'kegiatan.required' => 'Kegiatan tidak boleh kosong.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'lokasi.required' => 'Lokasi tidak boleh kosong.',
        ] );
        $jadwal = Jadwal::findOrFail( $id );
        if ( $jadwal->id_pembina != $user->id_pembina ) {
            return redirect()->back()->with( 'error', 'Anda tidak memiliki izin untuk mengubah jadwal ini.' );
        }
        // $jadwal->id_pembina = $user->id_pembina;
        $jadwal->kegiatan = $request->kegiatan;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal->lokasi = $request->lokasi;
        $jadwal->save();
        return redirect()->back()->with( 'success', 'Jadwal berhasil diperbarui.' );
    }

    public function hapusJadwal( $id ) {
        $jadwal = Jadwal::findOrFail( $id );
        $jadwal->delete();
        return redirect()->back()->with( 'success', 'Jadwal berhasil dihapus.' );
    }
    /**
    * Display a listing of the resource.
    */

    public function index() {
        //
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( StoreJadwalRequest $request ) {
        //
    }

    /**
    * Display the specified resource.
    */

    public function show( Jadwal $jadwal ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Jadwal $jadwal ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( UpdateJadwalRequest $request, Jadwal $jadwal ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Jadwal $jadwal ) {
        //
    }
}
