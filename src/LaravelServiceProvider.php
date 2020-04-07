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
    }

    public function provides()
    {
        return [Application::class, 'verider'];
    }
}