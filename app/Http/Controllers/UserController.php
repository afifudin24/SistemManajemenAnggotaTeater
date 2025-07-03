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

    public function getAnggota() {
        $anggota = Anggota::paginate( 10 );
        return view( 'admin.user.anggota', compact( 'anggota' ) );
    }

    public function getBendahara() {
        $bendahara = Bendahara::paginate( 10 );
        return view( 'admin.user.bendahara', compact( 'bendahara' ) );
    }

    public function getPembina() {
        $pembina = Pembina::paginate( 10 );
        return view( 'admin.user.pembina', compact( 'pembina' ) );
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

}
