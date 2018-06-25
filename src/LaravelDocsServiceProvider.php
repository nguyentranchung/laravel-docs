<?php

namespace ChungNT\LaravelDocs;

use Illuminate\Support\ServiceProvider;

class LaravelDocsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'LRDocs');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/laraveldocs.php', 'laraveldocs'
        );
    }
}
