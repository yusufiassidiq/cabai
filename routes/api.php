<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');    
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

// INI SEMENTARA DICOMMENT untuk ujicoba frontend
Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');

    Route::delete('/user/{id}','AdminController@delete')->middleware('isAdmin');
    Route::put('/terima/{id}','AdminController@terima')->middleware('isAdmin');
    Route::put('/tolak/{id}','AdminController@tolak')->middleware('isAdmin');
    Route::get('/admindashboard','AdminController@dashboardAdmin')->middleware('isAdmin');

    //BA Admin
    Route::post('/addTargetAdmin','AdminController@addTarget');
    Route::get('/readTargetAdmin','AdminController@readTarget');
    Route::put('/updateTargetAdmin/{id}','AdminController@updateTarget');
    Route::delete('/deleteTargetAdmin/{id}','AdminController@deleteTarget');
    Route::get('/getTargetAdmin','AdminController@getTarget');
    
    //Get Custom Payload
    // Route::get('user/getcustompayloads','UserController@seeToken');
    //Admin
    Route::get('/user/requested', 'UserController@requesteduser')->middleware('isAdmin');
    Route::get('/user/validated', 'UserController@validateduser')->middleware('isAdmin');
    Route::put('/user/terima/{id}','AdminController@terima')->middleware('isAdmin');
    Route::put('/user/tolak/{id}','AdminController@tolak')->middleware('isAdmin');
    Route::delete('/user/delete/{id}','AdminController@delete')->middleware('isAdmin');
    Route::get('/admin/dashboard','AdminController@dashboardAdmin')->middleware('isAdmin');

    //----Baru----
    //Chat
    Route::get('/chat/contact/list','ChatController@get');
    Route::get('/chat/conversation/{id}','ChatController@getMessagesFor');
    Route::post('/chat/conversation/send','ChatController@send');
    //------------

    //Kemitraan
    Route::post('/kemitraan/request/{id}','UserController@requestMitra');
    Route::put('/kemitraan/terima/{id}','UserController@terimaMitra');
    Route::put('/kemitraan/tolak/{id}','UserController@tolakMitra');
    Route::delete('/kemitraan/delete/{id}','UserController@hapusMitra');

    Route::get('/kemitraan/pengajuan/list','UserController@listPengajuanMitra');
    Route::get('/kemitraan/permintaan/list','UserController@listPermintaanMitra');
    Route::get('/kemitraan/mitra/list','UserController@listMitraSaya');
    //----baru----//
    Route::get('/kemitraan/mitraPemasok/list','UserController@listMitraPemasok');
    //------------//
    Route::get('/kemitraan/produsen/list','UserController@getMitraProdusen');
    Route::get('/kemitraan/pengepul/list','UserController@getMitraPengepul');
    Route::get('/kemitraan/grosir/list','UserController@getMitraGrosir');
    Route::get('/kemitraan/pengecer/list','UserController@getMitraPengecer');
    Route::get('/kemitraan/konsumen/list','UserController@getMitraKonsumen');
    // jumlah mitra saya
    Route::get('/kemitraan/mitra/info','UserController@InfoKemitraan');

    //Transaksi Permintaan Cabai
    Route::post('/transaksi/permintaanSaya/tambah','UserController@addPermintaanSaya');
    Route::get('/transaksi/permintaanSaya/list','UserController@getPermintaanSaya');
    Route::get('/transaksi/riwPermintaanSaya/list','UserController@getRiwayatPermintaanSaya');
    Route::put('/transaksi/permintaanSaya/update/{id}','UserController@requestUlangPermintaanSaya');
    Route::get('/transaksi/permintaanMasuk/list','UserController@getPermintaanMasuk');
    Route::get('/transaksi/riwPermintaanMasuk/list','UserController@getRiwayatPermintaanMasuk');
    Route::put('/transaksi/permintaanMasuk/terima/{id}','UserController@terimaPermintaanMasuk');
    Route::put('/transaksi/permintaanPembeli/tolak/{id}','UserController@tolakPermintaanPembeli');
    Route::put('/transaksi/penawaranPemasok/tolak/{id}','UserController@tolakPenawaranPemasok');
    Route::put('/transaksi/penawaranPemasok/terima/{id}','UserController@terimaPenawaranPemasok');
    Route::delete('/transaksi/permintaanPesanan/delete/{id}','UserController@hapusPermintaanPesanan');

    //Inventaris
    Route::get('/inventaris/list','UserController@getInventaris');
    //---sementara---
    // Route::put('/inventaris/tambah','UserController@addInventaris');
    //--------------
    Route::put('/inventaris/stokKeluar/{id}','UserController@stokKeluar');
    Route::put('/inventaris/stokMasuk/{id}','UserController@stokMasuk');
    
    //Manajemen lahan
    Route::post('/praProduksi/tambah','ProdusenController@addLahan');
    Route::get('/praProduksi/list','ProdusenController@readLahan');
    Route::get('/praProduksi/list/all','ProdusenController@readAllLahan');
    Route::put('/praProduksi/update/{id}','ProdusenController@updateLahan');
    Route::delete('/praProduksi/delete/{id}','ProdusenController@deleteLahan');
    //---baru---//
    //Panen
    Route::post('/panen/tambah','ProdusenController@addPanen');
    Route::get('/panen/list','ProdusenController@getPanen');
    Route::put('/panen/update/{id}','ProdusenController@updatePanen');
    Route::delete('/panen/delete/{id}','ProdusenController@deletePanen');
    //----------//
    //Pengeluaran Produksi
    Route::post('/pengeluaran/tambah','ProdusenController@addPengeluaran');
    Route::get('/pengeluaran/list','ProdusenController@readPengeluaran');
    Route::put('/pengeluaran/update/{id}','ProdusenController@updatePengeluaran');
    Route::delete('/pengeluaran/delete/{id}','ProdusenController@deletePengeluaran');
    
    //Business Analytic
    Route::post('/addTarget','AnalysisController@addTarget');
    Route::put('/updateTarget/{id}','AnalysisController@updateTarget');
    Route::delete('/deleteTarget/{id}','AnalysisController@deleteTarget');
    Route::get('/getTarget','AnalysisController@getTarget');
    Route::get('/getPengeluaran','AnalysisController@getPengeluaran');
    Route::get('/getPenjualan','AnalysisController@getPenjualan');
    Route::get('/getHarga','AnalysisController@getHarga');
    Route::get('/getSummaryProdusen','AnalysisController@getSummaryProdusen');
});

// TANPA LOGIN
Route::get('/getUserCount','AnalysisHomeController@getUserCount'); //test
Route::get('/getAllUserLocation','AnalysisHomeController@getAllUserLocation');
Route::get('/getAllHarga','AnalysisHomeController@getAllHarga');
Route::get('/getDaerah','AnalysisHomeController@getDaerah');
Route::get('/getHarga/{idKab}/{idRole}','AnalysisHomeController@getHarga');
Route::get('/getProduksi/{idKab}','AnalysisHomeController@getProduksi');
Route::get('/getStok/{idKab}','AnalysisHomeController@getStok');
Route::get('/getProduktivitas/{idKab}','AnalysisHomeController@getProduktivitas');


// Route::resources([
//     'user' => 'API\DummyController',
// ]);

// Route::resource('user', 'API\DummyController');
