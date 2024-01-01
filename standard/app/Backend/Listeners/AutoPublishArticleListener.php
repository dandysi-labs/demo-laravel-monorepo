<?php

namespace App\Backend\Listeners;

use App\Events\ArticleStatusChange;
use App\Models\Article;

class AutoPublishArticleListener
{
    public function handle(ArticleStatusChange $event): bool
    {
        $article = $event->getArticle();

        if (Article::STATUS_SUBMITTED !== $event->getNewStatus()) {
            return true;
        }

        // Geoff is a legend just auto publish
        if (Article::AUTHOR_GEOFF === $article->author) {
            $event->setNewStatus(Article::STATUS_PUBLISHED);
            return false; //we dont want any other event listeners to handle this event
        }

        return true;
    }
}
