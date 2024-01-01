<?php

namespace Chores;

use Chores\Commands\CreateArticleCommand;
use Chores\Commands\PurgeArticlesCommand;
use Chores\Listeners\ArticleStatusChangeListener;
use Chores\Listeners\AssignCreatedByListener;
use Common\Events\ArticleCreate;
use Common\Events\ArticleStatusChange;
use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Illuminate\Console\Scheduling\Schedule;

class MonorepoProvider extends BaseMonorepoProvider
{
    protected function registerCommands(): array
    {
        return [
            PurgeArticlesCommand::class,
            CreateArticleCommand::class
        ];
    }

    protected function registerSchedule(Schedule $schedule): void
    {
        $schedule->command(PurgeArticlesCommand::class)->everyTenMinutes();
        $schedule->command(CreateArticleCommand::class)->everyMinute();
    }

    protected function registerEventListeners(): array
    {
        return [
            ArticleStatusChange::class => [
                ArticleStatusChangeListener::class //should never get called in this microservice
            ],
            ArticleCreate::class => [
                AssignCreatedByListener::class
            ]
        ];
    }
}
