<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

//auth
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\PasswordResetController;

//external
use App\Http\Controllers\persyaratanExternal;
use App\Http\Controllers\kontakadminExternal;
use App\Http\Controllers\pengumumanExternal;
use App\Http\Controllers\Peserta\CetakPDFController;

//user
use App\Http\Controllers\Peserta\DashboardController;
use App\Http\Controllers\Peserta\kontakdansyaratController;
use App\Http\Controllers\Peserta\TagihanController;
use App\Http\Controllers\Peserta\DatadiriController;

//admin
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\admin\kontakadminContoller;
use App\Http\Controllers\Admin\rekeningController;
use App\Http\Controllers\Admin\settingwebController;
use App\Http\Controllers\Admin\persyaratanController;
use App\Http\Controllers\Admin\DafatarakunController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\InfolombaController;
use App\Http\Controllers\Admin\DatadiripesertaController;
use App\Http\Controllers\Admin\PembayaranpesertaController;
use App\Http\Controllers\Admin\TagihanPeserta;
use App\Http\Controllers\Admin\DaftarofflineController;
use App\Http\Controllers\Admin\ImportdatakolektifController;
use App\Imports\KolektifImport;
use App\Exports\DataExport;
use App\Http\Controllers\Admin\ExportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Root route khusus
Route::get('/', function () {
    $pathToFile = public_path('web/index.html');

    if (!File::exists($pathToFile)) {
        abort(404);
    }

    return Response::file($pathToFile);
});

// Catch-all route untuk frontend SPA
Route::get('/{any}', function ($any) {
    $pathToFile = public_path('web/index.html');

    if (!File::exists($pathToFile)) {
        abort(404);
    }

    return Response::file($pathToFile);
})->where('any', '^(?!api|admin|auth|test|home|logout|storage|web\/static|password|register|login|qrc|pengumuman|persyaratan|kontakadmin).*$');


Route::get('/password/request', [PasswordResetController::class, 'showRequestForm'])->name('password.request.form');
Route::post('/password/request', [PasswordResetController::class, 'requestReset'])->name('password.request');

Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset.form')
    ->middleware('signed');

Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])
    ->name('password.reset');

    Route::get('/qrc/{token}', [CetakPDFController::class, 'show'])->name('qr.show');
    Route::get('/pengumuman', [pengumumanExternal::class, 'index'])->name('pengumuman');
    Route::get('/persyaratan', [persyaratanExternal::class, 'index'])->name('persyaratan');
    Route::get('/kontakadmin', [kontakadminExternal::class, 'index'])->name('kontakadmin');


//rote untuk guest
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('auth.register');
    Route::post('/register', [UserController::class, 'registerPost'])->name('auth.register');
    Route::get('/login', [UserController::class, 'login'])->name('auth.login');
    Route::post('/login', [UserController::class, 'loginPost'])->name('auth.login');
});

//route untuk peserta
Route::middleware(['auth'])->group(function () {
    // Dashboard User
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home/kontakadmin', [kontakdansyaratController::class, 'kontakadmin'])->name('peserta.kontakadmin');
    Route::get('/home/persyaratanperserta', [kontakdansyaratController::class, 'syarat'])->name('peserta.persyaratan');
    Route::get('/home/profil', [UserController::class, 'profil'])->name('peserta.profil');

    //tagihan
    Route::get('/home/tagihan', [TagihanController::class, 'index'])->name('peserta.tagihan.tagihan');
    Route::post('/home/tagihan/upload/{id}', [TagihanController::class, 'uploadBukti'])->name('tagihan.upload');
    Route::get('/home/tagihan/cetak-tagihan/{id}', [CetakPDFController::class, 'cetakTagihan'])->name('tagihan.cetakpeserta');

    //data diri
    Route::get('/home/dataperserta', [DatadiriController::class, 'index'])->name('peserta.datadiri.index');
    Route::get('/home/dataperserta/create', [DatadiriController::class, 'create'])->name('datadiri.create');
    Route::post('/home/dataperserta', [DatadiriController::class, 'store'])->name('datadiri.store');
    Route::get('/home/dataperserta/edit', [DatadiriController::class, 'edit'])->name('datadiri.edit');
    Route::put('/home/dataperserta/update', [DatadiriController::class, 'update'])->name('datadiri.update');
    Route::post('/home/dataperserta/pilih-mapel', [TagihanController::class, 'pilihMapel'])->name('datadiri.pilihMapel');
    Route::get('/home/peserta/cetak-kartu-peserta/{id}', [CetakPDFController::class, 'cetakKartuPeserta'])->name('cetak.kartupeserta');

    // Logout User
    Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');
});


//route untuk admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('auth.loginAdmin');
Route::post('/admin/login', [AdminController::class, 'loginadminpost']);


Route::middleware('auth:admin')->group(function () {
    //dashboard admin
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index']);
    Route::post('/admin/logout', [AdminController::class, 'logoutadmin'])->name('auth.logoutadmin');

    //profile admin
    Route::get('/admin/profil', [AdminController::class, 'profil'])->name('profileadmin/profil');

    // Pengumuman
    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/admin/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/admin/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/admin/pengumuman/{id}', [PengumumanController::class, 'updatePengumuman'])->name('pengumuman.updatePengumuman');
    Route::delete('/admin/pengumuman/{id}', [PengumumanController::class, 'hapusPengumuman'])->name('pengumuman.destroy');

    //persyaratan
    Route::get('/admin/persyaratan', [PersyaratanController::class, 'index'])->name('persyaratan.index');
    Route::get('/admin/persyaratan/create', [PersyaratanController::class, 'create'])->name('persyaratan.create');
    Route::post('/admin/persyaratan', [PersyaratanController::class, 'store'])->name('persyaratan.store');
    Route::get('/admin/persyaratan/{id}/edit', [PersyaratanController::class, 'edit'])->name('persyaratan.edit');
    Route::put('/admin/persyaratan/{id}', [PersyaratanController::class, 'updatesyarat'])->name('persyaratan.update');
    Route::delete('/admin/persyaratan/{id}', [PersyaratanController::class, 'hapus'])->name('persyaratan.destroy');

    //rekening
    Route::get('/admin/rekening', [rekeningController::class, 'index'])->name('rekening.index');
    Route::get('/admin/rekening/edit', [rekeningController::class, 'editRekening'])->name('rekening.edit');
    Route::post('/admin/rekening/update', [rekeningController::class, 'updateRekening'])->name('rekening.update');

    //kontak admin
    Route::get('/admin/kontakadmin', [kontakadminContoller::class, 'index'])->name('kontakadmin.index');
    Route::get('/admin/kontakadmin/create', [kontakadminContoller::class, 'create'])->name('kontakadmin.create');
    Route::post('/admin/kontakadmin', [kontakadminContoller::class, 'store'])->name('kontakadmin.store');
    Route::get('/admin/kontakadmin/{id}/edit', [kontakadminContoller::class, 'edit'])->name('kontakadmin.edit');
    Route::put('/admin/kontakadmin/{id}', [kontakadminContoller::class, 'updateKontakadmin'])->name('kontakadmin.update');
    Route::delete('/admin/kontakadmin/{id}', [kontakadminContoller::class, 'hapusKontakadmin'])->name('kontakadmin.destroy');

    //setting
    Route::get('/admin/settingweb', [settingwebController::class, 'index'])->name('settingweb.index');
    Route::get('/admin/settingweb/edit', [settingwebController::class, 'editsettingweb'])->name('settingweb.edit');
    Route::post('/admin/settingweb/update', [settingwebController::class, 'updateSettingweb'])->name('settingweb.update');

    //reset password user
    Route::get('/admin/password-requests', [PasswordResetController::class, 'showAdminRequests'])->name('admin.password.requests');
    Route::patch('/admin/password/approve/{id}', [PasswordResetController::class, 'approveReset'])->name('password.approve');

    //daftar akun
    Route::get('/admin/dafatarakun', [DafatarakunController::class, 'index'])->name('daftarakun.index');
    Route::delete('/admin/dafatarakun/{id}', [DafatarakunController::class, 'destroy'])->name('daftarakun.destroy');

    //info lomba
    Route::get('/admin/infolomba', [InfolombaController::class, 'index'])->name('infolomba.index');
    Route::get('/admin/infolomba/create', [InfolombaController::class, 'create'])->name('infolomba.create');
    Route::post('/admin/infolomba', [InfolombaController::class, 'store'])->name('infolomba.store');
    Route::get('/admin/infolomba/{id}/edit', [InfolombaController::class, 'edit'])->name('infolomba.edit');
    Route::put('/admin/infolomba/{id}', [InfolombaController::class, 'update'])->name('infolomba.update');
    Route::delete('/admin/infolomba/{id}', [InfolombaController::class, 'destroy'])->name('infolomba.destroy');

    //data diri peserta online
    Route::get('/admin/peserta/online', [DatadiripesertaController::class, 'index'])->name('online.index');
    Route::post('/admin/peserta/online/switch-validasi/{id}', [DatadiripesertaController::class, 'switchValidasi'])
    ->name('online.switchValidasi');
    Route::get('/admin/peserta/online/show/{id}', [DatadiripesertaController::class, 'show'])->name('online.show');
    Route::get('/admin/peserta/online/{id}/edit', [DatadiripesertaController::class, 'edit'])->name('Admin.datadiripeserta.online.edit');
    Route::post('/admin/peserta/online/{id}/update', [DatadiripesertaController::class, 'update'])->name('online.update');
    Route::delete('/admin/peserta/online/{id}', [DatadiripesertaController::class, 'destroy'])->name('online.destroy');

    //data diri peserta offline
    Route::get('/admin/peserta/offline', [DaftarofflineController::class,'index'])->name('ofline.index');
    Route::get('/admin/peserta/offline/create', [DaftarofflineController::class,'create'])->name('ofline.create');
    Route::post('/admin/peserta/offline/create', [DaftarofflineController::class,'store'])->name('ofline.store');
    Route::post('/admin/peserta/offline/pilihMapel', [DaftarofflineController::class,'pilihMapel'])->name('ofline.pilihMapel');
    Route::delete('/admin/peserta/offline/{id}', [DaftarofflineController::class, 'destroy'])->name('ofline.destroy');
    Route::get('/admin/peserta/offline/show/{id}', [DaftarofflineController::class, 'show'])->name('ofline.show');
    Route::get('/admin/peserta/offine/{id}/edit', [DaftarofflineController::class, 'edit'])->name('Admin.datadiripeserta.ofline.edit');
    Route::post('/admin/peserta/offine/{id}/update', [DaftarofflineController::class, 'update'])->name('ofline.update');

    //datadiri peserta kolektif
    Route::get('/admin/peserta/kolektif', [ImportdatakolektifController::class, 'index'])->name('kolektif.index');
    Route::post('/admin/peserta/kolektif/import', [ImportdatakolektifController::class, 'importExcelkolektif'])->name('kolektif.import');
    Route::get('/admin/peserta/kolektif/{id}/edit', [ImportdatakolektifController::class, 'edit'])->name('kolektif.edit');
    Route::post('/admin/peserta/kolektif/{id}/update', [ImportdatakolektifController::class, 'update'])->name('kolektif.update');
    Route::delete('/admin/peserta/kolektif/{id}', [ImportdatakolektifController::class, 'destroy'])->name('kolektif.destroy');
    Route::get('/admin/peserta/kolektif/show/{id}', [ImportdatakolektifController::class, 'show'])->name('kolektif.show');

    //semua data peserta
    Route::get('/admin/peserta/semuadata', [DatadiripesertaController::class, 'semuaData'])->name('semua.index');
    Route::get('/admin/peserta/semuadata/export/download', [ExportController::class, 'export'])->name('export.download');
    Route::get('/admin/peserta/cetak-kartu-peserta/{id}', [CetakPDFController::class, 'cetakKartuPeserta'])->name('cetak.kartu');

    //tagihan
    Route::get('/admin/tagihan', [TagihanPeserta::class, 'index'])->name('tagihan.index');
    Route::delete('/admin/tagihan/{id}', [TagihanPeserta::class,'destroy'])->name('tagihan.destroy');
    Route::get('/admin/tagihan/export/download', [ExportController::class, 'exportTagihan'])->name('tagihan.export');
    Route::get('/admin/tagihan/cetak-tagihan/{id}', [CetakPDFController::class, 'cetakTagihan'])->name('tagihan.cetak');


    //pembayaran
    Route::get('/admin/pembayaran', [PembayaranpesertaController::class,'index'])->name('pembayaran.index');
    Route::post('/admin/pembayaran/switch-validasi/{id}', [PembayaranpesertaController::class, 'validbukti'])->name('pembayaran.validbukti');
});