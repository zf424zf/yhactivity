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

Route::get('/haha', function () {
    \Request::session()->flush();
     $userLuckCountKey = cache_key('user.luck.count', 13);
     return cache()->forget($userLuckCountKey);
//    return (new \App\Http\Service\live())->getLiveList();
});


Route::get('/mn', function () {

});
Route::group(['prefix' => 'video'], function () {
    Route::get('/', 'VideoController@videoIndexView');
    Route::get('question', 'VideoController@questionListView');
    Route::get('detail/{id}', 'VideoController@detailView');
    Route::get('rank', 'VideoController@listView');
    Route::get('new', 'VideoController@listNewView');



});
Route::group(['prefix' => 'photo'], function () {
    Route::get('/', 'ImageController@indexView');
    Route::get('/list/new', 'ImageController@newView');
    Route::get('/list/rank', 'ImageController@rankView');
    Route::get('/detail/{id}', 'ImageController@detailView');
    Route::get('/challenge/{module}', 'ImageController@challengeView');
    Route::get('/uploadImage/{module}', 'ImageController@uploadImageView');
    Route::get('/upload/success/{id}', 'ImageController@uploadSuccessView');
});
Route::group(['prefix' => 'lucky'], function () {
    Route::get('/', 'LuckController@indexView');
    Route::get('/wall', 'LuckController@shareWallView');
    Route::get('/detail/{id}', 'LuckController@shareDetailView');
    Route::get('/rank/{section}', 'LuckController@shareRankView');
    Route::get('/prize', 'LuckController@luckView');


});
Route::get('getNiceUser', 'UserController@niceUser');
Route::get('/live', 'LiveController@liveListView');
Route::get('/live/{id}', 'LiveController@detail');
Route::get('/', 'IndexController@index');
