<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Pembina;
use App\Models\Jadwal;
use App\Models\Punishment;
use App\Models\Kehadiran;
use App\Models\Keuangan;
use App\Models\Bendahara;
use App\Models\Anggota;

class DashboardController extends Controller {
    public function index() {
        $role = session( 'role' );
        $user = session( 'user' );
        if ( $role == 'admin' ) {
            $admin = Admin::where( 'status', '1' )->count();
            $pembina = Pembina::where( 'status', '1' )->count();
            $bendahara = Bendahara::where( 'status', '1' )->count();
            $anggota = Anggota::where( 'status', '1' )->count();
            $datapembina = Pembina::where( 'status', '1' )->get();
            return view( 'admin.dashboard', compact( 'admin', 'pembina', 'datapembina',  'bendahara', 'anggota' ) );
        } elseif ( $role == 'pembina' ) {
            $totalanggota = Anggota::where( 'id_pembina', $user->id_pembina )->count();
            $totaljadwal = Jadwal::where( 'id_pembina', $user->id_pembina )->count();
            $totalpunishment = Punishment::where( 'id_pembina', $user->id_pembina )->count();
            $totalkehadiran = Kehadiran::where( 'id_pembina', $user->id_pembina )->count();
            return view( 'pembina.dashboard', compact( 'totalanggota', 'totaljadwal', 'totalpunishment', 'totalkehadiran' ) );
        } elseif ( $role == 'bendahara' ) {
            $bulanIni = date( 'm' );
            $pemasukan = Keuangan::where( 'jenis', 'pemasukan' )->whereMonth( 'tanggal', $bulanIni )->sum( 'jumlah' );
            $pengeluaran = Keuangan::where( 'jenis', 'pengeluaran' )->whereMonth( 'tanggal', $bulanIni )->sum( 'jumlah' );
            $saldoTerkini = Keuangan::where( 'jenis', 'pemasukan' )->sum( 'jumlah' ) - Keuangan::where( 'jenis', 'pengeluaran' )->sum( 'jumlah' );
            return view( 'bendahara.dashboard', compact( 'pemasukan', 'pengeluaran', 'bulanIni', 'saldoTerkini' ) );
            // return view( 'bendahara.dashboard' );
        } elseif ( $role == 'anggota' ) {
            $punishment = Punishment::where( 'id_anggota', $user->id_anggota )->where( 'status_punishment', 'Perlu Upload Karya' )->count();
            $pembina = Pembina::where( 'id_pembina', $user->id_pembina )->first();
            $totalJadwal = Jadwal::where( 'id_pembina', $user->id_pembina )->count();
            $totalPunishment = Punishment::where( 'id_anggota', $user->id_anggota )->count();
            $totalKehadiranBulanIni = Kehadiran::where( 'id_anggota', $user->id_anggota )->where( 'status_kehadiran', 'Hadir' )->whereMonth( 'tanggal_pencatatan', date( 'm' ) )->count();
            return view( 'anggota.dashboard', compact( 'pembina', 'totalJadwal', 'totalPunishment', 'totalKehadiranBulanIni', 'punishment' ) );
        }

    }
}
