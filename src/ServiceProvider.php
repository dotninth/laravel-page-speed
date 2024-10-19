<?php

declare(strict_types=1);

namespace DotNinth\LaravelTachyon;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-tachyon.php' => config_path('laravel-tachyon.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-tachyon.php', 'laravel-tachyon.php');
    }
}
