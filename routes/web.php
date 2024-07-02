<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KapasitasMejaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
use App\Models\KapasitasMeja;
use App\Models\Kuliner;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;

Route::middleware(['auth', 'ceklevel:Admin'])->group(function () {
    Route::resource('/slider', SliderController::class);
    Route::resource('/user', UserController::class);
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
});

Route::middleware(['auth', 'ceklevel:Admin,User'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-index')->middleware('2fa');
    Route::resource('/kuliner', KulinerController::class);
    Route::resource('/galeri', GaleriController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/tour', TourController::class);
    Route::resource('/makanans', MakananController::class);
    Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::get('/indexreservasi', [ReservasiController::class, 'indexReservasi'])->name('indexreservasi');
    Route::get('/rating', [RatingController::class, 'index'])->name('rating.index');
    Route::resource('/metodepembayaran', MetodePembayaranController::class);
    Route::resource('/kapasitasmeja', KapasitasMejaController::class);
});

Route::get('/2fa', [LoginController::class, 'show2faForm'])->name('2fa.show')->middleware('auth', 'ceklevel:Admin,User');
Route::post('/2fa/authenticate', [LoginController::class, 'authenticate2fa'])->name('2fa.authenticate')->middleware('auth', 'ceklevel:Admin,User');

Route::middleware(['auth', 'ceklevel:Admin,User,Pengunjung'])->group(function () {
    Route::resource('/profil', ProfilController::class);
    Route::get('/halaman-profil', [ProfilController::class, 'index'])->name('halaman-profil');
});


// Route::get('/halaman_reservasi', [ReservasiController::class, 'index'])->name('halaman_reservasi')->middleware('auth');
Route::get('/halaman-reservasi', [ReservasiController::class, 'index'])->name('halaman-reservasi')->middleware('auth');

Route::get('/ulasan/create/{reservasi_id}', [UlasanController::class, 'create'])->name('ulasan.create')->middleware('auth', 'redirect.if.reviewed');
Route::post('/ulasan/store', [UlasanController::class, 'store'])->name('ulasan.store')->middleware('auth');
Route::delete('/ulasan/{ulasan}', [UlasanController::class, 'hapus'])->name('ulasan.destroy')->middleware('auth');

Route::post('/kontak/store', [KontakController::class, 'tambah'])->name('kontak.store')->middleware('auth');
Route::get('/halaman_kontak', [KontakController::class, 'kontak'])->name('halaman_kontak');

Route::get('detail_kuliner/{id}', [BerandaController::class, 'detailkuliner'])->name('detail_kuliner');

Route::get('detail_kuliner/encrypted/{id}', [BerandaController::class, 'detailkulinerEncrypted'])->name('detail_kuliner.encrypted');
Route::get('/halaman_wisata', [BerandaController::class, 'wisata'])->name('halaman_wisata');
Route::get('/halaman_kuliner', [BerandaController::class, 'kuliner'])->name('halaman_kuliner');
Route::get('/halaman_galeri', [BerandaController::class, 'galeri'])->name('halaman_galeri');
Route::get('/semua-galeri/{id}', [BerandaController::class, 'allgaleri'])->name('semua-galeri');

Route::post('/ratings/{id}', [RatingController::class, 'store'])->name('ratings.store')->middleware('auth');
Route::get('/form-rating/{id}', [RatingController::class, 'showRatingForm'])->name('form-rating')->middleware('auth');


Route::get('/halaman_detailreservasi/{id}', [ReservasiController::class, 'showDetail'])->name('halaman_detailreservasi')->middleware('auth');
Route::post('/simpan-reservasi', [ReservasiController::class, 'simpanReservasi'])->name('simpan_reservasi')->middleware('auth');

Route::put('/reservasi/{id}/konfirmasi', [ReservasiController::class, 'konfirmasiReservasi'])->name('reservasi.konfirmasi')->middleware('auth');
Route::put('/reservasi/{id}/lunas', [ReservasiController::class, 'lunasReservasi'])->name('reservasi.lunas')->middleware('auth');

Route::get('/pembayaran/{reservasi}', [PembayaranController::class, 'index'])->name('pembayaran.index')->middleware('auth');
Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store')->middleware('auth');

// Rute untuk membatalkan reservasi
Route::delete('/reservasi/{id}', [ReservasiController::class, 'cancelReservasi'])->name('reservasi.cancel')->middleware('auth');
// Hapus reservasi pada admin
Route::delete('/reservasi/{id}', [ReservasiController::class, 'hapusReservasi'])->name('reservasi.cancel')->middleware('auth');
Route::get('/reservasi/{id}/show', [ReservasiController::class, 'show'])->name('reservasi.show')->middleware('auth');

Route::get('/', [BerandaController::class, 'index']);

Route::get('/halaman-pembayaran-berhasil', function () {
    return view('halaman-pembayaran-berhasil');
})->name('pembayaran.berhasil')->middleware('auth');

Route::get('/get-metode-pembayaran/{id}', [MetodePembayaranController::class, 'getMetodePembayaran']);
Route::get('/check-meja-availability/{id_meja}', [ReservasiController::class, 'checkMejaAvailability']);

Route::resource('/beranda', BerandaController::class);

Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login-post', [LoginController::class, 'authenticate'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('logoutgues', [LoginController::class, 'logoutgues'])->name('logoutgues');
});

Route::get('/get-meja-tersedia/{kuliner_id}', [ReservasiController::class, 'getAvailableTables']);
