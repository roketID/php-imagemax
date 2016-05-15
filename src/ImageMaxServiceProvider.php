<?php

namespace RoketId\ImageMax;

use Illuminate\Support\ServiceProvider;

class ImageMaxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/imagemax.php' => $this->app->configPath().'/'.'imagemax.php',
        ], 'config');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/imagemax.php', 'imagemax');

        $this->app->bind('imagemax', function () {

            $config = config('imagemax');
            return new ImageMax($config);

        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides()
    {
        return ['imagemax'];
    }
}
