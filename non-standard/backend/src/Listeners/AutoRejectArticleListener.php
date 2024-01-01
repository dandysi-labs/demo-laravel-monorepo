<?php

namespace Backend\Listeners;

use Common\Events\ArticleStatusChange;
use Common\Models\Article;

class AutoRejectArticleListener
{
    public function handle(ArticleStatusChange $event): void
    {
        $article = $event->getArticle();

        if (Article::STATUS_SUBMITTED !== $event->getNewStatus()) {
            return;
        }

        //no one wants to read these
        if (Article::CATEGORY_OTHER === $article->category) {
            $event->setNewStatus(Article::STATUS_REJECTED);
        }
    }
}
