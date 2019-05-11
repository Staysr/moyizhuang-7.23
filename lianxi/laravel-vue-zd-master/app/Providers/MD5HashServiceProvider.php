<?php

namespace App\Providers;

use App\Foundations\HasherMD5;
use Illuminate\Support\ServiceProvider;

class MD5HashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hash', function () {
            return new HasherMD5();
        });
    }
}
