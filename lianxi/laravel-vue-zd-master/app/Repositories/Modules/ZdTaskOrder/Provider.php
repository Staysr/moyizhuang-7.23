<?php

namespace App\Repositories\Modules\ZdTaskOrder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use Config;
use luffyzhao\laravelTools\Repositories\Cache\LaravelCache;
use App\Model\ZdTaskOrder;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(Interfaces::class, function (Application $app) {
            $repository = new Eloquent(new ZdTaskOrder());
            if (!Config::get('app.cache')) {
                return $repository;
            }

            $cache = new LaravelCache($app['cache'], 'ZdTaskOrder', 3600);

            return new Cache($repository, $cache);
        });
    }
}
