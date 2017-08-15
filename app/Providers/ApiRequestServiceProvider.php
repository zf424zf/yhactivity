<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Request\ApiRequest;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
class ApiRequestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configureFormRequests();
    }

    protected function configureFormRequests()
    {

        $this->app->afterResolving(ValidatesWhenResolved::class, function ($resolved) {
            $resolved->validate();
        });

        $this->app->resolving(ApiRequest::class, function ($request, $app) {
            $this->initializeRequest($request, $app['request']);

            $request->setContainer($app);
        });
    }

    /**
     * Initialize the form request with data from the given request.
     *
     * @param  \App\Http\Request\ApiRequest  $form
     * @param  \Symfony\Component\HttpFoundation\Request  $current
     * @return void
     */
    protected function initializeRequest(ApiRequest $form, Request $current)
    {
        $files = $current->files->all();

        $files = is_array($files) ? array_filter($files) : $files;

        $form->initialize(
            $current->query->all(), $current->request->all(), $current->attributes->all(),
            $current->cookies->all(), $files, $current->server->all(), $current->getContent()
        );

    }
}
