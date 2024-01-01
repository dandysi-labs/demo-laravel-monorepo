<?php

namespace App\Chores;

use App\Chores\Commands\CreateArticleCommand;
use App\Chores\Commands\PurgeArticlesCommand;
use App\Chores\Listeners\ArticleStatusChangeListener;
use App\Chores\Listeners\AssignCreatedByListener;
use App\Events\ArticleCreate;
use App\Events\ArticleStatusChange;
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
