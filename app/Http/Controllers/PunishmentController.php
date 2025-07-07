<?php

namespace App\Http\Controllers;

use App\Models\Punishment;
use App\Http\Requests\StorePunishmentRequest;
use App\Http\Requests\UpdatePunishmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PunishmentController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $user = session()->get( 'user' );
        $punishment = Punishment::where( 'id_anggota', $user->id_anggota )->paginate( 10 );
        return view( 'anggota.punishment', compact( 'punishment' ) );
    }

    public function kirimKarya( Request $request, $id ) {
        $user = session()->get( 'user' );
        $punishment = Punishment::findOrFail( $id );

        // Validasi file
        $request->validate( [
            'karya' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ] );

        if ( $request->hasFile( 'karya' ) ) {
            $file = $request->file( 'karya' );
            // Simpan ke storage/app/karya dan dapatkan path-nya
            if ( $punishment->karya && Storage::disk( 'public' )->exists( $punishment->karya ) ) {
                Storage::disk( 'public' )->delete( $punishment->karya );
                $message = 'Karya berhasil diperbarui';
            } else {
                $message = 'Karya berhasil dikirim';
            }
            $path = $request->file( 'karya' )->store( 'karya', 'public' );
            // Simpan nama path ke database
            $punishment->karya = $path;
            $punishment->status_punishment = 'Menunggu Konfirmasi';
            $punishment->save();
        }

        return redirect()->route( 'punishment.index' )->with( 'success', $message );
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

    public function store( StorePunishmentRequest $request ) {
        //
    }

    /**
    * Display the specified resource.
    */

    public function show( Punishment $punishment ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Punishment $punishment ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( UpdatePunishmentRequest $request, Punishment $punishment ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Punishment $punishment ) {
        //
    }
}
