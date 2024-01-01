<?php

namespace App\Listeners;

use App\Events\ArticleCreate;
use App\Models\Article;

class PrioritiseArticleListener
{
    public function handle(ArticleCreate $event): void
    {
        $article = $event->getArticle();

        if (Article::CATEGORY_LARAVEL === $article->category) {
            $article->priority = Article::PRIORITY_HIGH;
        }
    }
}
