<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\JadwalController;
use App\Http\Middleware\CekLogin;
Route::get('/', function () {
    if (session()->has('user')) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
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
    Route::put('/updateadmin/{id}', [UserController::class, 'updateAdmin'])->name('admin.update');
    Route::delete('/hapusadmin/{id}', [UserController::class, 'hapusAdmin'])->name('admin.delete');

    // Route anggota
    Route::post('/tambahanggota', [UserController::class, 'tambahAnggota'])->name('anggota.store');
    Route::put('/updateanggota/{id}', [UserController::class, 'updateAnggota'])->name('anggota.update');
    Route::delete('/hapusanggota/{id}', [UserController::class, 'hapusAnggota'])->name('anggota.delete');

    // Route pembina
    Route::post('/tambahpembina', [UserController::class, 'tambahPembina'])->name('pembina.store');
    Route::put('/updatepembina/{id}', [UserController::class, 'updatePembina'])->name('pembina.update');
    Route::delete('/hapuspembina/{id}', [UserController::class, 'hapusPembina'])->name('pembina.delete');

    // Route bendahara
    Route::post('/tambahbendahara', [UserController::class, 'tambahBendahara'])->name('bendahara.store');
    Route::put('/updatebendahara/{id}', [UserController::class, 'updateBendahara'])->name('bendahara.update');
    Route::delete('/hapusbendahara/{id}', [UserController::class, 'hapusBendahara'])->name('bendahara.delete');
});

Route::middleware([CekLogin::class . ':pembina,anggota'])->group(function () {
    // Jadwal Teater
    Route::get('/jadwalteater', [JadwalController::class, 'getJadwal'])->name('jadwal');
});

Route::middleware([CekLogin::class . ':pembina'])->group(function () {
    // Kelola jadwal teater
    Route::post('/tambahjadwal', [JadwalController::class, 'tambahJadwal'])->name('jadwal.store');
    Route::put('/updatejadwal/{id}', [JadwalController::class, 'updateJadwal'])->name('jadwal.update');
    Route::delete('/hapusjadwal/{id}', [JadwalController::class, 'hapusJadwal'])->name('jadwal.delete');

    // Absen Anggota
    Route::get('/absenanggota', [KehadiranController::class, 'index'])->name('kehadiran');
    Route::post('/absenanggota', [KehadiranController::class, 'tambahKehadiran'])->name('kehadiran.store');
    Route::put('/absenanggota', [KehadiranController::class, 'updateKehadiran'])->name('kehadiran.update');

    // Rekap Absen Anggota
    Route::get('/rekapabsenanggota', [KehadiranController::class, 'rekapAbsenAnggota'])->name('kehadiran.rekap');
    Route::get('/rekap/pdf', [KehadiranController::class, 'exportPdf'])->name('kehadiran.rekap.pdf');

});

Route::middleware([CekLogin::class . ':bendahara'])->group(function () {
    // Kelola Keuangan
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::post('/tambahkeuangan', [KeuanganController::class, 'store'])->name('keuangan.store');
    Route::put('/updatekeuangan/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
    Route::delete('/hapuskeuangan/{id}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');
    Route::get('/rekapkas', [KeuanganController::class, 'rekap'])->name('keuangan.rekap');

});

Route::middleware([CekLogin::class . ':anggota,pembina'])->group(function () {
    Route::get('/kasteater', [KeuanganController::class, 'kasteater'])->name('keuangan.kasteater');

    Route::get('/punishment', [PunishmentController::class, 'index'])->name('punishment.index');
    Route::put('/kirimkarya/{id}', [PunishmentController::class, 'kirimKarya'])->name('punishment.kirim');
});

Route::middleware([CekLogin::class . ':bendahara, admin'])->group(function () {
      Route::get('/keuangan/rekap-pdf', [KeuanganController::class, 'cetakPDF'])->name('keuangan.cetakPDF');

});
Route::middleware([CekLogin::class . ':anggota'])->group(function () {
    Route::get('/absensaya', [KehadiranController::class, 'absenSaya'])->name('kehadiran.saya');


});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
