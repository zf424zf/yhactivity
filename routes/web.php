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

Route::get('/mikeSay', function () {
    $module = \Request::get('module');
    $target = \Request::get('target');
    $child = \Request::get('child');
    $uid = 17;
    $created = \Carbon\Carbon::now()->timestamp;
    $updated = \Carbon\Carbon::now()->timestamp;
    $num = \Request::get('num',1000);
    $likes = [];
    if(empty($module)||empty($target)||empty($child)||empty($num))return 'no';
    for ($i = 0; $i < $num; $i++) {
        array_push($likes, ['module' => $module, 'uid' => $uid, 'target_id' => $target, 'created_at' => $created, 'updated_at' => $updated, 'child' => $child]);
    }
    $count = \App\Http\Models\LikeModel::insert($likes);
    return $count;
//    \Request::session()->flush();
//     $userLuckCountKey = cache_key('user.luck.count', 13);
//     return cache()->forget($userLuckCountKey);
//    return (new \App\Http\Service\live())->getLiveList();
});


Route::get('/mn', function () {

});
Route::group(['prefix' => 'video'], function () {
    Route::get('question', 'VideoController@questionListView');
    Route::get('detail/{id}', 'VideoController@detailView');
    Route::get('rank', 'VideoController@listView');
    Route::get('new', 'VideoController@listNewView');
    Route::get('/{id}', 'VideoController@videoIndexView');
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
