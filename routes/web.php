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
    Route::get('perda/get-sub-tahapan/{id}', 'PerdaController@subTahapanByTahapan')->name('perda.subTahapanByTahapan');
    Route::post('perda/simpan-rekam-jejak', 'PerdaController@storeRekamJejak')->name('perda.storeRekamJejak');
    Route::get('perda/edit-rekam-jejak/{id}', 'PerdaController@editRekamJejak')->name('perda.editRekamJejak');
    Route::post('perda/update-rekam-jejak/{id}', 'PerdaController@updateRekamJejak')->name('perda.updateRekamJejak');
    Route::delete('perda/delete-rekam-jejak/{id}', 'PerdaController@deleteRekamJejak')->name('perda.deleteRekamJejak');
    Route::get('delete-file-rekam-jejak', 'PerdaController@deleteFileRekamJejak')->name('perda.deleteFileRekamJejak');

    // Aspirasi
    Route::resource('aspirasi', 'AspirasiController');
    Route::post('aspirasi/api', 'AspirasiController@api')->name('aspirasi.api');

    // Konseling 
    Route::get('konseling', 'KonselingController@index')->name('konseling.index');
    Route::get('konseling/{id}', 'KonselingController@show')->name('konseling.show');
    Route::post('konseling/update/{id}', 'KonselingController@update')->name('konseling.update');
    Route::post('konseling/api', 'KonselingController@api')->name('konseling.api');
});
