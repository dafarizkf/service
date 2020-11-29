<?php

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

Route::get('/', function () {
    return view('welcome');
});

// --------------------------- Hak Akses Admin -------------------------------------
//--------------------------- ( Wajib Login ) --------------------------------------
Route::get('/login', 'AuthController@ViewLogin')->name('login');
Route::get('/logout', 'AuthController@Logout');
Route::post('/cekLogin', 'AuthController@CekLogin');


Route::group(['middleware' => ['auth', 'checkRole:admin']], function(){
	Route::post('/simpan_akun', 'KelolaAkun@SimpanAkun');
	Route::get('/kelola_akun', 'KelolaAkun@ViewKelolaAkun');
	Route::get('/hapus_akun/{id}', 'KelolaAkun@HapusAkun');
	

});

// ---------------------- Hak Akses Admin Dan Pekerja ------------------------------
//--------------------------- ( Wajib Login ) --------------------------------------
Route::group(['middleware' => ['auth', 'checkRole:admin,pekerja']], function(){
	Route::get('/dashboard', 'KelolaDashboard@ViewDashboard');
	Route::get('/daftar_pesanan', 'KelolaPemesanan@ViewPemesanan');
	Route::get('/daftar_perbaikan', 'KelolaPerbaikan@ViewPerbaikan');
	Route::get('/daftar_pengembalian', 'KelolaPengembalian@ViewPengembalian');
	Route::post('/simpan_pemesanan', 'KelolaPemesanan@SimpanPemesanan');
	Route::post('/proses_perbaikan', 'KelolaPerbaikan@ProsesPerbaikan');
	Route::post('/bayar/{id}', 'KelolaPengembalian@Bayar')->name('selesai');
	Route::get('/hapus_pemesanan/{id}', 'KelolaPemesanan@HapusPemesanan');
	Route::get('/edit_pemesanan/{id}', 'KelolaPemesanan@edit');
	Route::get('/cetak_pemesanan/{id}', 'KelolaPemesanan@Cetak');
	Route::post('/update_pemesanan/{id}','KelolaPemesanan@UpdatePemesanan');
	Route::get('/perbaiki_barang/{id}', 'KelolaPemesanan@PerbaikiBarang');
	Route::get('/selesai_show/{id}', 'KelolaPerbaikan@SelesaiShow');
	Route::get('/proses_pembayaran/{id}', 'KelolaPengembalian@ProsesPembayaran');
	Route::get('/laporan','KelolaLaporan@index');
	// Route::get('/laporan/pdf/{id}','');
	// Route::get('/laporan/excel/{id}','');
});


// ----------------------- LOGIN DAN REGISTER BAWAAN ------------------------------
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/selesai_transaksi{id}','KelolaPengembalian@selesai');
