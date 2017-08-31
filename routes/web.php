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
    \Request::session()->flush();
});



Route::get('/mn', function () {
    $redirect = \Request::get('redirect_uri');
    $uid = 'zf_002';
    $name = '闪电西兰花2';
     $avatar = 'http://img08.oneniceapp.com/upload/avatar/2017/08/30/0f0bb3df9d85f191f6b0634e48efa409.jpg';
    return redirect($redirect."?uid=$uid&name=$name&avatar=$avatar");
});
Route::group(['prefix' => 'video'], function () {
    Route::get('question', 'VideoController@questionListView');
});
Route::group(['prefix' => 'photo'], function () {
    Route::get('/', 'ImageController@indexView');
    Route::get('/list/new', 'ImageController@newView');
    Route::get('/list/rank', 'ImageController@rankView');
    Route::get('/detail/{id}', 'ImageController@detailView');
    Route::get('/challenge/{module}', 'ImageController@challengeView');


});
Route::get('getNiceUser','UserController@niceUser');

//Route::get('/','IndexController@index');
