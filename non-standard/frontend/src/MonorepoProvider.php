<?php

namespace Frontend;

use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Illuminate\Support\Facades\Route;

class MonorepoProvider extends BaseMonorepoProvider
{
    protected function registerRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ .'/../routes.php')
        ;
    }

    protected function registerConfig(): array
    {
        return ['frontend' => require __DIR__ . '/../config.php'];
    }
}
