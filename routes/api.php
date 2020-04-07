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
    //Test
    Route::delete('/user/{id}','AdminController@delete')->middleware('isAdmin');
    Route::post('/terima/{id}','AdminController@terima')->middleware('isAdmin');
    //Get Custom Payload
    // Route::get('user/getcustompayloads','UserController@seeToken');
    // get user yang belum divalidasi
    Route::get('requesteduser', 'UserController@requesteduser')->middleware('isAdmin');
    // get user yang sudah divalidasi
    Route::get('validateduser', 'UserController@validateduser')->middleware('isAdmin');
    //Manajemen lahan
    Route::post('/addLahan','ProdusenController@addLahan');
    Route::get('/readLahan','ProdusenController@readLahan');
});

// Route::resources([
//     'user' => 'API\DummyController',
// ]);

// Route::resource('user', 'API\DummyController');
