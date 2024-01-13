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

    public static function dbConnectionsConfig(array $connections): array
    {
        //say we had replicated dbs and we wanted frontend to use read/write configs for performance gains

        $connections['mysql']['read'] = [
            'host' => explode(',', env('SLAVE_DB_HOST', '127.0.0.1')),
            'username' => env('SLAVE_DB_USERNAME', ''),
            'password' => env('SLAVE_DB_PASSWORD', ''),
        ];

        $connections['mysql']['write'] = [
            'host' => env('DB_HOST', '127.0.0.1')
        ];

        unset($connections['mysql']['host']);

        return $connections;
    }
}
