<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Pembina;
use App\Models\Bendahara;
use App\Models\Anggota;

class AuthController extends Controller {
    public function showLoginForm() {
        return view( 'auth.login' );
    }

    public function login( Request $request ) {
        $request->validate( [
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required|in:admin,pembina,bendahara,anggota',
        ] );

        $username = $request->username;
        $password = $request->password;
        $role     = $request->role;

        $user = null;

        switch ( $role ) {
            case 'admin':
            $user = Admin::where( 'username', $username )->first();
            break;
            case 'pembina':
            $user = Pembina::where( 'username', $username )->first();
            break;
            case 'bendahara':
            $user = Bendahara::where( 'username', $username )->first();
            break;
            case 'anggota':
            $user = Anggota::where( 'username', $username )->first();
            break;
        }

        if ( $user && Hash::check( $password, $user->password ) ) {
            // Simpan user info ke session
            Session::put( 'login', true );
            Session::put( 'role', $role );
            Session::put( 'user', $user );

            return redirect( '/dashboard' );
        }

        return back()->with( 'error', 'Username atau password salah.' );
    }

    public function logout() {
        Session::flush();
        return redirect()->route( 'login' );
    }
}
