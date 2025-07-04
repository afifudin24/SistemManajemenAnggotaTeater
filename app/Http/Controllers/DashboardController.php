<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Pembina;
use App\Models\Bendahara;
use App\Models\Anggota;

class DashboardController extends Controller {
    public function index() {
        $role = session( 'role' );
        if ( $role == 'admin' ) {
            $admin = Admin::where( 'status', '1' )->count();
            $pembina = Pembina::where( 'status', '1' )->count();
            $bendahara = Bendahara::where( 'status', '1' )->count();
            $anggota = Anggota::where( 'status', '1' )->count();
            return view( 'admin.dashboard', compact( 'admin', 'pembina', 'bendahara', 'anggota' ) );
        } elseif ( $role == 'pembina' ) {
            return view( 'pembina.dashboard' );
        } elseif ( $role == 'bendahara' ) {
            return view( 'bendahara.dashboard' );
        } elseif ( $role == 'anggota' ) {
            return view( 'anggota.dashboard' );
        }

    }
}
