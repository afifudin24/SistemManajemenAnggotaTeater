<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CekLogin;
Route::get('/', function () {
    return view('tes');
});
// Route group middleware auth
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
Route::middleware([CekLogin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware([CekLogin::class . ':admin'])->group(function () {
    Route::get('/adminusers', [UserController::class, 'getAdmin'])->name('admin');
    Route::get('/anggotausers', [UserController::class, 'getAnggota'])->name('anggota');
    Route::get('/pembinausers', [UserController::class, 'getPembina'])->name('pembina');
    Route::get('/bendaharausers', [UserController::class, 'getBendahara'])->name('bendahara');

    // tambah user
    Route::post('/tambahuser', [UserController::class, 'tambahAdmin'])->name('admin.store');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');