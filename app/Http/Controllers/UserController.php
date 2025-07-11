<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Pembina;
use App\Models\Bendahara;

class UserController extends Controller {
    public function getAdmin() {
        $admin = Admin::paginate( 10 );
        return view( 'admin.user.admin', compact( 'admin' ) );
    }

    public function tambahAdmin( Request $request ) {
        // Validasi input
        $request->validate( [
            'admin_name' => 'required|string|max:255',
            'username' => 'required|string|max:20',

            'password' => 'required|min:6',
        ], [
            'admin_name.required' => 'Nama wajib diisi.',
            'admin_name.string' => 'Nama harus berupa teks.',
            'admin_name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ] );

        // Simpan data admin
        $admin = new Admin();
        $admin->admin_name = $request->admin_name;

        $admin->username = $request->username;

        $admin->password = bcrypt( $request->password );
        $admin->status = 1;
        $admin->save();

        return redirect()->route( 'admin' )->with( 'success', 'Admin berhasil ditambahkan.' );
    }

    public function updateAdmin( $id, Request $request ) {
        // Validasi input
        $request->validate( [
            'admin_name' => 'required|string|max:255',
            'username' => 'required|string|max:20',
        ], [
            'admin_name.required' => 'Nama wajib diisi.',
            'admin_name.string' => 'Nama harus berupa teks.',
            'admin_name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        ] );

        // Simpan data admin
        $admin = Admin::find( $id );
        $admin->admin_name = $request->admin_name;
        $admin->username = $request->username;
        $admin->save();

        return redirect()->route( 'admin' )->with( 'success', 'Admin berhasil diperbarui.' );
    }

    public function hapusAdmin( $id ) {
        $admin = Admin::find( $id );
        $admin->delete();
        return redirect()->route( 'admin' )->with( 'success', 'Admin berhasil dihapus.' );
    }

    public function getAnggota() {
        $anggota = Anggota::paginate( 10 );
        $pembina = Pembina::all();
        return view( 'admin.user.anggota', compact( 'anggota', 'pembina' ) );
    }

    public function tambahAnggota( Request $request ) {
        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'kelas'     => 'required|string|max:5',
            'password' => 'required|min:6',
            'id_pembina' => 'required',
            'nis' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.string' => 'Kelas harus berupa teks.',
            'kelas.max' => 'Kelas tidak boleh lebih dari 5 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'id_pembina.required' => 'Pembina wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
        ] );

        // Simpan data admin
        $anggota = new Anggota();
        $anggota->nama = $request->nama;
        $anggota->username = $request->username;
        $anggota->kelas = $request->kelas;
        $anggota->id_pembina = $request->id_pembina;
        $anggota->nis = $request->nis;
        $anggota->password = bcrypt( $request->password );
        $anggota->status = 1;
        $anggota->save();

        return redirect()->route( 'anggota' )->with( 'success', 'Anggota berhasil ditambahkan.' );
    }

    public function updateAnggota( $id, Request $request ) {
        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'kelas'     => 'required|string|max:5',
            'id_pembina' => 'required',
            'nis' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.string' => 'Kelas harus berupa teks.',
            'kelas.max' => 'Kelas tidak boleh lebih dari 5 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',

            'id_pembina.required' => 'Pembina wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
        ] );

        // Simpan data admin
        $anggota = Anggota::find( $id );
        $anggota->nama = $request->nama;
        $anggota->username = $request->username;
        $anggota->kelas = $request->kelas;
        $anggota->nis = $request->nis;
        $anggota->id_pembina = $request->id_pembina;
        $anggota->save();

        return redirect()->route( 'anggota' )->with( 'success', 'Anggota berhasil diperbarui.' );
    }

    public function hapusAnggota( $id ) {
        $anggota = Anggota::find( $id );
        $anggota->delete();
        return redirect()->route( 'anggota' )->with( 'success', 'Anggota berhasil dihapus.' );
    }

    public function getBendahara() {
        $bendahara = Bendahara::paginate( 10 );
        return view( 'admin.user.bendahara', compact( 'bendahara' ) );
    }

    public function tambahBendahara( Request $request ) {
        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',

            'password' => 'required|min:6',
            'periode' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',

            'periode.required' => 'Periode wajib diisi.',
        ] );

        // Simpan data admin
        $bendahara = new Bendahara();
        $bendahara->nama = $request->nama;

        $bendahara->username = $request->username;
        $bendahara->password = bcrypt( $request->password );
        $bendahara->periode = $request->periode;
        $bendahara->status = 1;
        $bendahara->save();

        return redirect()->route( 'bendahara' )->with( 'success', 'Bendahara berhasil ditambahkan.' );
    }

    public function updateBendahara( $id, Request $request ) {
        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'periode' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',

            'periode.required' => 'Periode wajib diisi.',
        ] );

        // simpan data
        $bendahara = Bendahara::find( $id );
        $bendahara->nama = $request->nama;
        $bendahara->username = $request->username;
        $bendahara->periode = $request->periode;
        $bendahara->save();

        return redirect()->route( 'bendahara' )->with( 'success', 'Bendahara berhasil diperbarui.' );

    }

    public function hapusBendahara( $id ) {
        $bendahara = Bendahara::find( $id );
        $bendahara->delete();
        return redirect()->route( 'bendahara' )->with( 'success', 'Bendahara berhasil dihapus.' );
    }

    public function getPembina() {
        $pembina = Pembina::paginate( 10 );
        return view( 'admin.user.pembina', compact( 'pembina' ) );
    }

    public function tambahPembina( Request $request ) {
        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'nip' =>    'required|string|max:20',

            'password' => 'required|min:6',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP tidak boleh lebih dari 20 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ] );

        // Simpan data admin
        $pembina = new Pembina();
        $pembina->nama = $request->nama;

        $pembina->username = $request->username;
        $pembina->nip = $request->nip;

        $pembina->password = bcrypt( $request->password );
        $pembina->status = 1;
        $pembina->save();

        return redirect()->route( 'pembina' )->with( 'success', 'Pembina berhasil ditambahkan.' );
    }

    public function updatePembina( Request $request, $id ) {
        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'nip' =>    'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP tidak boleh lebih dari 20 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        ] );

        // Simpan data admin
        $pembina = Pembina::find( $id );
        $pembina->nama = $request->nama;

        $pembina->username = $request->username;
        $pembina->nip = $request->nip;

        $pembina->password = bcrypt( $request->password );
        $pembina->status = 1;
        $pembina->save();

        return redirect()->route( 'pembina' )->with( 'success', 'Pembina berhasil diupdate.' );

    }

    public function hapusPembina( $id ) {
        $pembina = Pembina::find( $id );
        $pembina->delete();
        return redirect()->route( 'pembina' )->with( 'success', 'Pembina berhasil dihapus.' );
    }

    public function profil() {
        $user = session()->get( 'user' );
        $role = session()->get( 'role' );
        if ( $role == 'pembina' ) {
            $pembina = Pembina::find( $user->id_pembina );
            return view( 'pembina.profil', compact( 'pembina' ) );
        } else if ( $role == 'anggota' ) {
            $anggota = Anggota::find( $user->id_anggota );
            return view( 'anggota.profil', compact( 'anggota' ) );
        } else if ( $role == 'bendahara' ) {
            $bendahara = Bendahara::find( $user->id_bendahara );
            return view( 'bendahara.profil', compact( 'bendahara' ) );
        } else if ( $role == 'admin' ) {
            $admin = Admin::find( $user->id_admin );
            return view( 'admin.profil', compact( 'admin' ) );
        }

        return view( 'admin.user.profil' );
    }

    public function updateprofilbendahara( Request $request ) {

        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'periode' =>    'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'periode.required' => 'Periode wajib diisi.',
            'periode.string' => 'Periode harus berupa teks.',
            'periode.max' => 'Periode tidak boleh lebih dari 20 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        ] );

        // Simpan data admin
        $user = session()->get( 'user' );
        $bendahara = Bendahara::find( $user->id_bendahara );
        // dd( $pembina );
        $bendahara->nama = $request->nama;

        $bendahara->username = $request->username;
        $bendahara->periode = $request->periode;

        if($request->password != '' || $request->password != null) {
            $bendahara->password = bcrypt( $request->password );
        }

        $bendahara->save();
        // update juga sessionuser nya
        session()->put( 'user', $bendahara );

        return redirect()->route( 'profil' )->with( 'success', 'Profil berhasil diupdate.' );
    }

    public function updateprofilpembina( Request $request ) {

        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',
            'nip' =>    'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP tidak boleh lebih dari 20 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        ] );

        // Simpan data admin
        $user = session()->get( 'user' );
        $pembina = Pembina::find( $user->id_pembina );
        // dd( $pembina );
        $pembina->nama = $request->nama;

        $pembina->username = $request->username;
        $pembina->nip = $request->nip;

        if($request->password != '' || $request->password != null) {
            $pembina->password = bcrypt( $request->password );
        }

        $pembina->save();
        // update juga sessionuser nya
        session()->put( 'user', $pembina );

        return redirect()->route( 'profil' )->with( 'success', 'Profil berhasil diupdate.' );
    }


    public function updateprofilanggota( Request $request ) {

        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',

        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'periode.required' => 'Periode wajib diisi.',
            'periode.string' => 'Periode harus berupa teks.',
            'periode.max' => 'Periode tidak boleh lebih dari 20 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        ] );

        // Simpan data admin
        $user = session()->get( 'user' );
        $anggota = Anggota::find( $user->id_anggota );
        // dd( $pembina );
        $anggota->nama = $request->nama;

        $anggota->username = $request->username;


        if($request->password != '' || $request->password != null) {
            $anggota->password = bcrypt( $request->password );
        }

        $anggota->save();
        // update juga sessionuser nya
        session()->put( 'user', $anggota );

        return redirect()->route( 'profil' )->with( 'success', 'Profil berhasil diupdate.' );
    }

    public function updateprofiladmin( Request $request ) {

        // Validasi input
        $request->validate( [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:20',


        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'periode.required' => 'Periode wajib diisi.',
            'periode.string' => 'Periode harus berupa teks.',
            'periode.max' => 'Periode tidak boleh lebih dari 20 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 20 karakter.',
        ] );

        // Simpan data admin
        $user = session()->get( 'user' );
        $admin = Admin::find( $user->admin_id );
        // dd( $pembina );
        $admin->admin_name = $request->nama;

        $admin->username = $request->username;


        if($request->password != '' || $request->password != null) {
            $admin->password = bcrypt( $request->password );
        }

        $admin->save();
        // update juga sessionuser nya
        session()->put( 'user', $admin );

        return redirect()->route( 'profil' )->with( 'success', 'Profil berhasil diupdate.' );
    }

}
