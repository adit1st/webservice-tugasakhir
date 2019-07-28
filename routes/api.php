<?php
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
     
        // Login User
        Route::post('login', 'AuthController@login');
        
        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');

        Route::resource('vmahasiswa', 'MahasiswaController');
        Route::resource('vmatakuliah', 'MatakuliahController');
        Route::resource('vdosen', 'DosenController');
        Route::resource('vprodi', 'ProdiController');
        
        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
          
            // Logout user from application
            Route::post('logout', 'AuthController@logout');

        });
    });
    Route::resource('mahasiswa', 'MahasiswaController');
    Route::resource('matakuliah', 'MatakuliahController');
    Route::resource('dosen', 'DosenController');
    Route::resource('prodi', 'ProdiController');
});