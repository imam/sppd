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
    $api->get('subkegiatan', \App\Http\Controllers\API\SubKegiatanController::class.'@index');
    $api->get('kegiatan/{id}/subkegiatan',\App\Http\Controllers\API\DPPA\KegiatanController::class.'@show_sub_kegiatan');
    $api->get('kegiatan/{id}',\App\Http\Controllers\API\DPPA\KegiatanController::class.'@show');
});
