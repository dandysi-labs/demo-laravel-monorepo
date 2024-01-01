<?php

namespace Common\Providers;

use Common\Console\Commands\HealthCheckCommand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        $this->commands([
            HealthCheckCommand::class
        ]);
    }
}
