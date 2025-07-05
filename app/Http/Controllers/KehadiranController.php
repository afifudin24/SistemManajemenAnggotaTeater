<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Kehadiran;
use App\Models\Jadwal;
use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKehadiranRequest;
use App\Http\Requests\UpdateKehadiranRequest;
use Illuminate\Support\Facades\Validator;

class KehadiranController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $user = session()->get( 'user' );

        $tanggalHariIni = Carbon::today()->toDateString();
        $jadwal = Jadwal::where( 'id_pembina', $user->id_pembina )->where( 'tanggal', $tanggalHariIni )->get();
        // YYYY-MM-DD
        $kehadiran = Kehadiran::where( 'id_pembina', $user->id_pembina )
        ->whereDate( 'tanggal_pencatatan', $tanggalHariIni )
        ->get();
        // dd( $kehadiran );
        $anggota = Anggota::where( 'id_pembina', $user->id_pembina )->get();
        return view( 'pembina.kehadiran', compact( 'jadwal', 'kehadiran', 'anggota', 'tanggalHariIni' ) );
    }

    public function tambahKehadiran( Request $request ) {
        $request->validate( [
            'kehadiran' => 'required|array',
            'kehadiran.*' => 'in:Hadir,Sakit, Izin ,Alpha',
        ], [
            'kehadiran.required' => 'Mohon isi kehadiran untuk semua anggota.',
            'kehadiran.*.in' => 'Status kehadiran tidak valid (harus Hadir/Sakit/Izin/Alpha).',
        ] );

        $id_pembina = session()->get( 'user' )->id_pembina;
        $tanggal = Carbon::today()->toDateString();
        $user = session()->get( 'user' );
        // dd( $user );
        foreach ( $request->kehadiran as $id_anggota => $status ) {
            Kehadiran::create( [
                // 'id_kehadiran' => 'KHD-' . strtoupper( Str::random( 6 ) ),
                'id_anggota' => $id_anggota,
                'id_jadwal' => $request->id_jadwal,
                'id_pembina' => $user->id_pembina,
                'tanggal_pencatatan' => $tanggal,
                'status_kehadiran' => $status,
                'catatan' => $request->catatan, // atau dari $request->catatan[ $id_anggota ] jika disediakan
            ] );
            // === CEK: Apakah perlu diberi punishment ===
            if ( $status === 'Alpha' ) {
                $jumlahAlpha = Kehadiran::where( 'id_anggota', $id_anggota )
                ->where( 'status_kehadiran', 'Alpha' )
                ->count();

                if ( $jumlahAlpha >= 3 ) {
                    // Cek apakah punishment untuk tanggal hari ini sudah ada
                    $sudahAda = Punishment::where( 'id_anggota', $id_anggota )
                    ->where( 'tanggal', $tanggal )
                    ->exists();

                    if ( !$sudahAda ) {
                        // Tambahkan punishment
                        Punishment::create( [
                            // 'id_punishment' => 'PUN-' . strtoupper( Str::random( 6 ) ),
                            'id_anggota' => $id_anggota,
                            'id_pembina' => $user->id_pembina,
                            'tanggal' => $tanggal,
                            // 'keterangan' => 'Alpha lebih dari 3x',
                        ] );
                    }
                }
            }
        }

        return redirect()->back()->with( 'success', 'Kehadiran berhasil dicatat.' );
    }

    public function updateKehadiran( Request $request ) {
        $user = session()->get( 'user' );

        // Validasi
        $validator = Validator::make( $request->all(), [
            'kehadiran' => 'required|array',
            'catatan' => 'nullable|string|max:255',
        ], [
            'kehadiran.required' => 'Data kehadiran harus diisi.',
        ] );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        }

        $tanggalHariIni = Carbon::today()->format( 'Y-m-d' );
        $catatan = $request->input( 'catatan' );

        foreach ( $request->input( 'kehadiran' ) as $idKehadiran => $status ) {
            // Update tiap kehadiran berdasarkan ID
            $kehadiran = Kehadiran::find( $idKehadiran );

            if ( $kehadiran && $kehadiran->id_pembina == $user->id_pembina ) {
                $kehadiran->status_kehadiran = $status;
                $kehadiran->catatan = $catatan;
                // overwrite semua jika diedit
                $kehadiran->tanggal_pencatatan = $tanggalHariIni;
                // update tanggal bila perlu
                $kehadiran->save();
            }
        }

        return redirect()->back()->with( 'success', 'Data kehadiran berhasil diperbarui.' );
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

    public function store( StoreKehadiranRequest $request ) {
        //
    }

    /**
    * Display the specified resource.
    */

    public function show( Kehadiran $kehadiran ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Kehadiran $kehadiran ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( UpdateKehadiranRequest $request, Kehadiran $kehadiran ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Kehadiran $kehadiran ) {
        //
    }
}
