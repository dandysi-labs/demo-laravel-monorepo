<?php

namespace App\Backend;

use App\Backend\Listeners\ArticleEventSubscriber;
use App\Backend\Listeners\AssignCreatedByListener;
use App\Backend\Listeners\AutoPublishArticleListener;
use App\Backend\Listeners\AutoRejectArticleListener;
use App\Events\ArticleCreate;
use App\Events\ArticleStatusChange;
use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Illuminate\Support\Facades\Route;

class MonorepoProvider extends BaseMonorepoProvider
{
    protected function registerRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/backend_api.php'))
        ;
    }

    protected function registerConfig(): array
    {
        return ['backend' => [
            'info' => 'This is the Backend API'
        ]];
    }

    protected function registerEventSubscribers(): array
    {
        return [
            ArticleEventSubscriber::class
        ];
    }

    protected function registerEventListeners(): array
    {
        return [
            ArticleCreate::class => [
                AssignCreatedByListener::class
            ],
            ArticleStatusChange::class => [
                AutoPublishArticleListener::class,
                AutoRejectArticleListener::class
            ]
        ];
    }
}
