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

//Route::get('/', function () {
//    $moduleRef = new \ReflectionClass(\App\Http\Api\Module::class);
//
//     var_dump(in_array(1,$moduleRef->getConstants()));
////    return view('welcome');
//});
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


Route::get('/','IndexController@index');
