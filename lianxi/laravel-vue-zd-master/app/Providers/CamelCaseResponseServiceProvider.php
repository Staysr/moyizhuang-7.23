<?php

namespace App\Providers;

use App\Foundations\CamelCaseResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class CamelCaseResponseServiceProvider extends ServiceProvider
{
    /**
     * register()
     */
    public function register()
    {
        $view = $this->app->make('view');
        $redirect = $this->app->make('redirect');
        $this->app->singleton(
            ResponseFactory::class,
            function () use ($view, $redirect) {
                return new CamelCaseResponse($view, $redirect);
            }
        );
    }
}
