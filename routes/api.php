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
Route::post('login', function() {
    $tes = request()->only('email', 'password');

    if (auth()->once($tes)){
    	return auth()->user();
    }
    return 'fail';
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/mahasiswa', 'MahasiswaController');
Route::resource('/matakuliah', 'MatakuliahController');
Route::resource('/dosen', 'DosenController');
Route::resource('/prodi', 'ProdiController');


