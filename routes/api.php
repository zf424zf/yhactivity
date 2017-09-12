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
    Route::get('msgList', 'MessageController@messageList');
});
Route::group(['prefix' => 'like'], function () {
    Route::post('/', 'LikeController@like');
});
Route::group(['prefix' => 'live'], function () {
    Route::get('/{id}', 'LiveController@listLive');
});

Route::group(['prefix' => 'wx'], function () {
    Route::get('/ticket', 'UserController@ticket');
    Route::post('/login', 'UserController@wxlogin');
});
Route::group(['prefix' => 'image'], function () {
    Route::post('/add', 'ImageController@add');
    Route::post('/share', 'ImageController@shareImage');
    Route::get('/info', 'ImageController@info');
    Route::get('/challengeList', 'ImageController@challengeList');
    Route::get('/challengeDetail', 'ImageController@challengeDetail');

});
Route::group(['prefix' => 'video'], function () {
    Route::post('/add', 'VideoController@addVideo');
    Route::get('/info', 'VideoController@info');
});
Route::get('/wall', 'VideoController@getList');
Route::post('upload', 'UploadController@upload');
Route::get('wall', 'ListController@getList');
Route::get('luck', 'LuckController@luck');
Route::get('luckList', 'LuckController@luckList');
Route::get('lucky', 'LuckController@sectionLucky');
Route::post('luck/contact', 'LuckController@luckyContact');

Route::get('question', 'VideoController@getQuestionList');
Route::get('questionDetail', 'VideoController@questionDetail');

Route::delete('file/del','UploadController@removeFile');