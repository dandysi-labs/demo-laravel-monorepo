<?php

namespace App\Chores\Commands;

use App\Services\ArticleService;
use Illuminate\Console\Command;

class CreateArticleCommand extends Command
{
    protected $signature = 'chores:create_article {category?}';
    protected $description = 'Create an article';

    public function handle(ArticleService $articleService): void
    {
        $articleService->generate($this->argument('category'));
        $this->info('Article created');
    }
}
