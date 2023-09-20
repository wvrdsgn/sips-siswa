<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Middleware agar user tidak lgsg pindah halaman(Hak Akses)
Route::middleware(['guest:siswa'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::POST('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::POST('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

Route::middleware(['auth:siswa'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //Presensi-Camera
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //EditProfile
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    //Histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //Izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/getizin', [PresensiController::class, 'getizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);
});

//Akses_Admin Only
Route::middleware(['auth:user', 'CekLevel:1'])->group(function () {

    //Siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::post('/siswa/edit', [SiswaController::class, 'edit']);
    Route::post('/siswa/{nis}/update', [SiswaController::class, 'update']);
    Route::post('/siswa/{nis}/delete', [SiswaController::class, 'delete']);
    Route::post('/siswa-import', [SiswaController::class, 'import']);

    //Kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas/store', [KelasController::class, 'store']);
    Route::post('/kelas/edit', [KelasController::class, 'edit']);
    Route::post('/kelas/{kode_kelas}/update', [KelasController::class, 'update']);
    Route::post('/kelas/{kode_kelas}/delete', [KelasController::class, 'delete']);

    //Users
    Route::get('/users', [AuthController::class, 'index']);
    Route::post('/users/store', [AuthController::class, 'store']);
    Route::post('/users/edit', [AuthController::class, 'edit']);
    Route::post('/users/{id}/update', [AuthController::class, 'update']);
    Route::post('/users/{id}/delete', [AuthController::class, 'delete']);

    //Konfigurasi
    Route::get('/konfigurasi/lokasisekolah', [KonfigurasiController::class, 'lokasisekolah']);
    Route::post('/konfigurasi/updatelokasisekolah', [KonfigurasiController::class, 'updatelokasisekolah']);

});
//Akses_Admin&User
Route::middleware(['auth:user', 'CekLevel:1,2'])->group(function () {

    //Proses_Administrator
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    //Monitoring
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta']);

    Route::get('/presensi/editpresensi', [PresensiController::class, 'editpresensi']);
    Route::post('/getedit', [PresensiController::class, 'getedit']);
    Route::post('/submitpresensi', [PresensiController::class, 'submitpresensi']);
    Route::post('/cancelpresensi/{nis}', [PresensiController::class, 'cancelPresensi'])
    ->name('cancel.presensi');


    // Laporan
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::match(['get', 'post'], '/getlaporan', [PresensiController::class, 'getlaporan']);
    Route::post('/presensi/printlaporan', [PresensiController::class, 'printlaporan']);
    Route::post('/presensi/exportlaporanpdf', [PresensiController::class, 'export']);

    //PersetujuanIzinSakit
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
    Route::get('/presensi/downloadlampiran/{id}', [PresensiController::class, 'downloadlampiran']);
    Route::post('/presensi/approval/', [PresensiController::class, 'approval']);
    Route::get('/presensi/{id}/cancelizinsakit', [PresensiController::class, 'cancelizinsakit']);
});
