<?php
/**
 * zdapp
 * LaravelServiceProvider.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Plugins\Auth\Providers;


use App\Plugins\Auth\DriverGuard;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app['auth']->extend('driver', function ($app, $name, array $config) {
            $guard = new DriverGuard(
                $app['auth']->createUserProvider($config['provider']),
                $app['request']
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}