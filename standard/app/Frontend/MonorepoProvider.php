<?php

namespace App\Frontend;

use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Illuminate\Support\Facades\Route;

class MonorepoProvider extends BaseMonorepoProvider
{
    protected function registerRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/frontend_api.php'))
        ;
    }
}
