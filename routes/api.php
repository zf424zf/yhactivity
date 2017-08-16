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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
    Route::group(['prefix' => 'comment'], function () {
        Route::post('submit', 'MessageController@submit');
        Route::get('msgList','MessageController@messageList');
});
Route::group(['prefix' => 'like','namespace'=>'App\Http\Controllers'], function () {
    Route::post('/', 'LikeController@like');
});
Route::post('upload', 'UploadController@upload');
