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
    return view('home');
});


Route::get('dppa/import','DPPAController@import');
Route::post('dppa/import','DPPAController@import_store');
Route::resource('dppa','DPPAController',[
    'names'=>[
    ]
]);
Route::resource('/program','ProgramController',[
    'only'=>['edit','update','show']
]);

Route::resource('kegiatan_id','KegiatanController',[
    'only' => ['edit','update','show'],
]);

Route::resource('subkegiatan','SubKegiatanController',[
    'only' => ['edit','update','show'],
]);

Route::get('/pegawai/import','PegawaiController@import')->name('pegawai.import');
Route::post('/pegawai/import','PegawaiController@store_import');
Route::resource('pegawai','PegawaiController');


Route::get('umk/create/tahun/{tahun_anggaran}','UMKController@create_page_2')->name('umk.create.page_2');
Route::get('umk/create/tahun/{tahun_anggaran}/kegiatan_id/{kegiatan_id}','UMKController@create_page_3')->name('umk.create.page_3');
Route::resource('umk','UMKController');
Route::resource('perjalanandinas','PerjalananDinasController');
Route::resource('hasilperjalanandinas','HasilPerjalananDinasController');
Route::resource('pembayaran','PembayaranController');

Auth::routes();

