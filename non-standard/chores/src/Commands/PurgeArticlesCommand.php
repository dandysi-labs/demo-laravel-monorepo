<?php

namespace Chores\Commands;

use Common\Services\ArticleService;
use Illuminate\Console\Command;

class PurgeArticlesCommand extends Command
{
    protected $name = 'chores:purge_articles';
    protected $description = 'Deletes all articles';

    public function handle(ArticleService $articleService): void
    {
        $articles = $articleService->all();

        foreach ($articles as $article) {
            //should delete all as backend listener should not get fired
            $articleService->delete($article);
        }

        $this->info('Deleted all articles');
    }
}
