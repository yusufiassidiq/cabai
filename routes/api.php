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
    //Get Custom Payload
    // Route::get('user/getcustompayloads','UserController@seeToken');

    // get user yang belum divalidasi
    Route::get('/requesteduser', 'UserController@requesteduser')->middleware('isAdmin');

    // get user yang sudah divalidasi
    Route::get('/validateduser', 'UserController@validateduser')->middleware('isAdmin');

    //Kemitraan
    Route::post('/requestMitra/{id}','UserController@requestMitra');
    Route::put('/terimaMitra/{id}','UserController@terimaMitra');
    Route::put('/tolakMitra/{id}','UserController@tolakMitra');
    Route::delete('/hapusmitra/{id}','UserController@hapusMitra');

    Route::get('/listPengajuanMitra','UserController@listPengajuanMitra');
    Route::get('/listPermintaanMitra','UserController@listPermintaanMitra');
    Route::get('/listMitraSaya','UserController@listMitraSaya');
    
    Route::get('/getMitraProdusen','UserController@getMitraProdusen');
    Route::get('/getMitraPengepul','UserController@getMitraPengepul');
    Route::get('/getMitraGrosir','UserController@getMitraGrosir');
    Route::get('/getMitraPengecer','UserController@getMitraPengecer');
    Route::get('/getMitrakonsumen','UserController@getMitraKonsumen');

    //Transaksi Permintaan Cabai
    Route::post('/addPermintaanSaya','UserController@addPermintaanSaya');
    Route::get('/getPermintaanMasuk','UserController@getPermintaanMasuk');
    Route::get('/getPermintaanSaya','UserController@getPermintaanSaya');
    Route::put('/tolakPermintaanPembeli/{id}','UserController@tolakPermintaanPembeli');
    Route::delete('/hapusPermintaanPesanan/{id}','UserController@hapusPermintaanPesanan');
    Route::put('/requestUlangPermintaanSaya/{id}','UserController@requestUlangPermintaanSaya');
    Route::put('/terimaPermintaanMasuk/{id}','UserController@terimaPermintaanMasuk');
    Route::put('/tolakPenawaranPemasok/{id}','UserController@tolakPenawaranPemasok');
    Route::put('/terimaPenawaranPemasok/{id}','UserController@terimaPenawaranPemasok');

    //Inventaris
    Route::get('/getInventaris','UserController@getInventaris');
    Route::put('/addInventaris','UserController@addInventaris');
    Route::put('/stokKeluar/{id}','UserController@stokKeluar');
    Route::put('/stokMasuk/{id}','UserController@stokMasuk');
    
    //Manajemen lahan
    Route::post('/addLahan','ProdusenController@addLahan');
    Route::get('/readLahan','ProdusenController@readLahan');
    Route::put('/updateLahan/{id}','ProdusenController@updateLahan');
    Route::delete('/deleteLahan/{id}','ProdusenController@deleteLahan');

    //Pengeluaran Produksi
    Route::post('/addPengeluaran','ProdusenController@addPengeluaran');
    Route::get('/readPengeluaran','ProdusenController@readPengeluaran');
    Route::put('/updatePengeluaran/{id}','ProdusenController@updatePengeluaran');
    Route::delete('/deletePengeluaran/{id}','ProdusenController@deletePengeluaran');
    
    //Business Analytic
    Route::post('/addTarget','AnalysisController@addTarget');
    Route::get('/readTarget','AnalysisController@readTarget');
    Route::put('/updateTarget/{id}','AnalysisController@updateTarget');
    Route::delete('/deleteTarget/{id}','AnalysisController@deleteTarget');
    Route::get('/getTarget','AnalysisController@getTarget');
    Route::get('/getPengeluaran','AnalysisController@getPengeluaran');
<<<<<<< HEAD
    Route::get('/getPenjualan','AnalysisController@getPenjualan');
=======
    
>>>>>>> fd240078208053c2e92bb70cce8c07809ffc4be3
});

// TANPA LOGIN
Route::get('/getUserCount','AnalysisHomeController@getUserCount'); //test
Route::get('/getAllUserLocation','AnalysisHomeController@getAllUserLocation');

// Route::resources([
//     'user' => 'API\DummyController',
// ]);

// Route::resource('user', 'API\DummyController');
