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
Route::group(['prefix' => 'like'], function () {
    Route::post('/', 'LikeController@like');
});
Route::group(['prefix' => 'image'], function () {
    Route::post('/add', 'ImageController@add');
});
Route::group(['prefix' => 'video'], function () {
    Route::post('/add', 'VideoController@addVideo');

});
Route::get('/wall', 'VideoController@getList');
Route::post('upload', 'UploadController@upload');
Route::get('/',function(){
    $model =  \App\Http\Models\VideoModel::class;
});