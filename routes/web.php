<?php

use App\Http\Controllers\activityLog;
use App\Http\Controllers\AdminAddKategori;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminPetugasControl;
use App\Http\Controllers\auth;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\bukuFilter;
use App\Http\Controllers\bukuPeminjaman;
use App\Http\Controllers\landingPage;
use App\Http\Controllers\laporan;
use App\Http\Controllers\LaporanBukuFavorit;
use App\Http\Controllers\LaporanBukuRusakAtauHilang;
use App\Http\Controllers\LaporanPeminjamanBuku;
use App\Http\Controllers\LaporanStokBuku;
use App\Http\Controllers\peminjamanBukuAdmin;
use App\Http\Controllers\peminjamBuku;
use App\Http\Controllers\profil;
use App\Http\Controllers\StokBukuControl;
use App\Http\Controllers\ulasan as ControllersUlasan;
use App\Http\Middleware\AdminDanPetugas;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\BannedCheck;
use App\Http\Middleware\checkBooking;
use App\Http\Middleware\checkTglPeminjaman;
use App\Models\ulasan;
use Illuminate\Support\Facades\Route;

Route::middleware([checkTglPeminjaman::class, checkBooking::class, BannedCheck::class])->group(function () {


    Route::get('/', [landingPage::class, 'index']);

    Route::get('aturan', function () {
        return view('aturan');
    })
        ->name('aturan');

    route::resource('landingPage', landingPage::class);
    route::resource('bukufilter', bukuFilter::class);


    //auth
    route::resource('auth', auth::class);
    route::post('LoginCek', [auth::class, 'cekLogin'])->name('LoginCek');
    route::post('OtpCheck', [auth::class, 'otpCheck'])->name('otpCheck');
    Route::get('otpCheck', [auth::class, 'ViewOtp'])->name('ViewOtp');
    Route::get('getTimeResent', [auth::class, 'getTimeResent'])->name('getTimeResent');
    Route::post('ResentOtp', [auth::class, 'ResentOtp'])->name('ResentOtp');

    route::post('forgotPasswordCheck', [auth::class, 'forgotPasswordCheck'])->name('forgotPasswordCheck');
    route::get('getSessiontime', [auth::class, 'getSessiontime'])->name('getSessiontime');
    route::get('EmailCheck', [auth::class, 'EmailCheck'])->name('EmailCheck');
    route::get('forgotPasswordView', [auth::class, 'forgotPasswordView'])->name('viewForgotPassword');

    //profil
    route::resource('PeminjamanBuku', bukuPeminjaman::class);
    route::get('favorit', [bukuPeminjaman::class, 'favorit'])->name('favorit');

    Route::middleware([AuthCheck::class])->group(function () {


        route::resource('profil', profil::class);
        route::get('detailPeminjaman/{id}', [bukuPeminjaman::class, 'detailPeminjaman'])->name('detailPeminjaman');
        route::get('viewFavorit/{id}', [bukuPeminjaman::class, 'viewFavorit'])->name('viewFavorit');

        route::resource('ulasan', ControllersUlasan::class);
    });



    //admin
    Route::middleware([AdminDanPetugas::class])->group(function () {
        route::resource('adminPetugas', AdminPetugasControl::class);
        route::resource('adminBuku', bukuController::class);
        route::resource('AdminDashboard', AdminDashboard::class);
        route::resource('adminKategori', AdminAddKategori::class);
        route::resource('adminKonfirmasiPeminjaman', peminjamanBukuAdmin::class);
        route::resource('peminjamBukuConrtol', peminjamBuku::class);
        route::resource('activityLog', activityLog::class);
        route::resource('stok', StokBukuControl::class);
        route::resource('laporanBukuFavorit', LaporanBukuFavorit::class);
        route::resource('laporanStokBuku', LaporanStokBuku::class);
        route::resource('laporanBukuRusakAtauHilang', LaporanBukuRusakAtauHilang::class);

        route::resource('laporanPeminjamanBuku', LaporanPeminjamanBuku::class);
        route::post('excel', [LaporanPeminjamanBuku::class, 'excel'])->name('excelLaporanPeminjaman');
        route::get('LinkExcel', [LaporanPeminjamanBuku::class, 'link'])->name('link');

        route::get('halamanKategori', [AdminAddKategori::class, 'index'])->name('halamanKategori');
        route::post('halamanKategori', [AdminAddKategori::class, 'store'])->name('storeKategori');
    });



    Route::post('CreatePassword', [auth::class, 'CreatePassword'])->name('CreatePassword');
    Route::get('ResetPassword/{param}', [auth::class, 'ResetPassword'])->name('ResetPassword');
});
