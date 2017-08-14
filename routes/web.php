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
    $moduleRef = new \ReflectionClass(\App\Http\Api\Module::class);

     var_dump(in_array(1,$moduleRef->getConstants()));
//    return view('welcome');
});
