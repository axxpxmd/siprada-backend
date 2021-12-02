<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Pengguna
    Route::resource('pengguna', 'PenggunaController');
    Route::post('pengguna/api', 'PenggunaController@api')->name('pengguna.api');
    Route::get('pengguna/cek-nik/{nik}', 'PenggunaController@cekNIK')->name('pengguna.cekNIK');
    Route::post('pengguna/update-status/{id}', 'PenggunaController@updateStatus')->name('pengguna.updateStatus');

    // Tahapan
    Route::resource('tahapan', 'TahapanController');
    Route::post('tahapan/api', 'TahapanController@api')->name('tahapan.api');

    // Sub Tahapan
    Route::resource('sub-tahapan', 'SubTahapanController');
    Route::post('sub-tahapan/api', 'SubTahapanController@api')->name('sub-tahapan.api');

    // Perda 
    Route::resource('perda', 'PerdaController');
    Route::post('perda/api', 'PerdaController@api')->name('perda.api');
    Route::post('perda/api2', 'PerdaController@api2')->name('perda.api2');
});
