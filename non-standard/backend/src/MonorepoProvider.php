<?php

namespace Backend;

use Backend\Listeners\ArticleEventSubscriber;
use Backend\Listeners\AssignCreatedByListener;
use Backend\Listeners\AutoPublishArticleListener;
use Backend\Listeners\AutoRejectArticleListener;
use Common\Events\ArticleCreate;
use Common\Events\ArticleStatusChange;
use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Illuminate\Support\Facades\Route;

class MonorepoProvider extends BaseMonorepoProvider
{
    protected function registerRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../routes.php')
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
