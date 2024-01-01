<?php

namespace App\Backend\Listeners;


use App\Events\ArticleDelete;
use App\Models\Article;
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
