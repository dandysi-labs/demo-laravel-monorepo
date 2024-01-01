<?php

namespace Common\Listeners;

use Common\Events\ArticleCreate;
use Common\Models\Article;

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
