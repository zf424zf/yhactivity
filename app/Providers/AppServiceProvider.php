<?php

namespace App\Providers;

use App\Http\Service\User;
use App\Http\Services\Settings;
use Illuminate\Support\ServiceProvider;
use App\Util\Validator as ExtendValidator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        app()->singleton('setting', function ($app) {
            return new Settings();
        });

        //重置校验类库为自定义扩展
        app('validator')->resolver(function ($translator, $data, $rules, $messages) {
            $instance = new ExtendValidator($translator, $data, $rules, $messages);
            return $instance;
        });

        app()->singleton('user', function ($app) {
            return new User();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
