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
//    return redirect(env('NICE_USER_PATH')."?redirect_uri=http://activity.dev/getNiceUser");
//    return redirect(env('NICE_USER_PATH')."?redirect_uri=http://activity.dev/getNiceUser");
//  return  (new \App\Http\Service\User())->niceUser(333,'wocao','http://img08.oneniceapp.com/upload/avatar/2017/08/30/0f0bb3df9d85f191f6b0634e48efa409.jpg');
//    return redirect("http://m.oneniceapp.com/go/redirectOpen?redirect_uri=".env('APP_URL').'/getNiceUser')->with('rdpath',\Request::path());
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
