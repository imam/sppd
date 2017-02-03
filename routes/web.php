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

Route::post('toggle_sidebar',function(\Illuminate\Http\Request $request){
    $current = $request->session()->get('sidebar_open',false);
    $request->session()->put('sidebar_open',!$current);
});

if(env('APP_ENV','local ')){
    Route::get('changeuser/{user}',function($user){
        Auth::loginUsingId($user);
        return redirect('/');
    });
}

Route::group(['middleware'=>['install','auth']],function(){
    Route::get('/', function () {
        return view('home',['title'=>'Dashboard']);
    });

    Route::get('bug',function(){
        return view('bug');
    });
    Route::post('bug',function(\Illuminate\Http\Request $request){
        Mail::to('imam@imam.tech')->send(
            new \App\Mail\BugReporting('kepo',$request->report_content)
        );
        return redirect()->back();
    });

    Route::get('/profile','ProfileController@edit');
    Route::post('/profile','ProfileController@update');

    Route::get('ganti_tahun_anggaran',function(Illuminate\Http\Request $request){
        $user = \App\User::find(Auth::id());
        $user->tahun_anggaran = $request->tahun;
        $user->save();
        return redirect('/');
    });

    Route::group(['middleware'=>'role:admin'],function(){

        Route::post('buattahunanggaran',function(Illuminate\Http\Request $request){
            $tahun_anggaran = \App\TahunAnggaran::create(['tahun'=>$request->tahun]);
            return redirect()->back();
        });

        Route::get('dppa/import','DPPAController@import');
        Route::post('dppa/import','DPPAController@import_store');

        Route::get('/pegawai/import','PegawaiController@import')->name('pegawai.import');
        Route::post('/pegawai/import','PegawaiController@store_import');
    });

    Route::group(['middleware'=>['role:admin|supervisor']],function(){

        Route::resource('program','ProgramController',['except'=>['destroy']]);

        Route::resource('kegiatan','KegiatanController', ['except'=>['destroy']]);

        Route::resource('subkegiatan','SubKegiatanController', ['except'=>['destroy']]);

        Route::resource('pegawai','PegawaiController');

        Route::resource('umk','UMKController');

    });

    Route::resource('dppa','DPPAController',['only' => ['index']]);

    Route::resource('program','ProgramController',['only' => ['index','show']]);

    Route::resource('kegiatan','KegiatanController', ['only'=>['show']]);

    Route::resource('subkegiatan','SubKegiatanController', ['only'=>['show']]);

    Route::resource('pegawai','PegawaiController',['only' => ['index']]);

    Route::resource('umk','UMKController',['except'=>'show']);

    Route::resource('perjalanandinas','PerjalananDinasController',['except'=>'show']);

    Route::resource('hasilperjalanandinas','HasilPerjalananDinasController',['except' => ['show']]);

    Route::get('hasilperjalanandinas/download/{id}','HasilPerjalananDinasController@download')
        ->name('hasilperjalanandinas.download');

    Route::resource('transaksiperjalanandinas','TransaksiPerjalananDinasController',['except' => ['show']]);

    Route::resource('pembayaran','PembayaranController',['except' => ['show']]);
});

Auth::routes();

Route::get('/install','InstallationController@get');

Route::post('firstsignup','InstallationController@signup');




