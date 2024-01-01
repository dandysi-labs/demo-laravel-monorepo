<?php

namespace Backend\Listeners;


use Common\Events\ArticleDelete;
use Common\Models\Article;
use Illuminate\Events\Dispatcher;

class ArticleEventSubscriber
{
    public function handleDelete(ArticleDelete $event): void
    {
        if (Article::CATEGORY_LARAVEL === $event->getArticle()->category) {
            //lets not allow this
            abort(403);
        }
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            ArticleDelete::class => 'handleDelete'
        ];
    }
}
