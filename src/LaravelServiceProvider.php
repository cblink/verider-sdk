<?php

namespace Cblink\Verider;

class LaravelServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Application::class, function(){
            return new Application(config('services.verider'));
        });

        $this->app->alias(Application::class, 'verider');

        $this->app->extend('log', function () {
            return app('log');
        });
    }

    public function provides()
    {
        return [Application::class, 'verider'];
    }
}