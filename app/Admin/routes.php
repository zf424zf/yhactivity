<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('question', 'QuestionController');
    $router->resource('setting', 'SettingController');
    $router->resource('section', 'SectionController');
    $router->resource('lucky', 'LuckyController');
    $router->resource('video', 'SelfVideoController');

});
