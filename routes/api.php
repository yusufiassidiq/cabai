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
    Route::post('/terima/{id}','AdminController@terima')->middleware('isAdmin');
    Route::post('/tolak/{id}','AdminController@tolak')->middleware('isAdmin');
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
});



// Route::resources([
//     'user' => 'API\DummyController',
// ]);

// Route::resource('user', 'API\DummyController');
