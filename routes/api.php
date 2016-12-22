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

$api = app(\Dingo\Api\Routing\Router::class);

$api->version('v1',function($api){
    $api->group(['prefix'=>'/dppa/program','middleware'=>'web'],function($api){
        $api->get('/',App\Http\Controllers\API\DPPA\ProgramController::class.'@index');
        $api->post('/import',\App\Http\Controllers\API\DPPA\ProgramController::class.'@store_import');
        $api->get('/{id}',\App\Http\Controllers\API\DPPA\ProgramController::class.'@show');
        $api->get('/kegiatan/{id}',\App\Http\Controllers\API\DPPA\KegiatanController::class.'@show');
    });

});
