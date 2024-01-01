<?php

namespace Chores\Listeners;

use Common\Events\ArticleStatusChange;

class ArticleStatusChangeListener
{
    public function handle(ArticleStatusChange $event): void
    {
        // this will never get called as the event should not be fired in this microservice
        // its here to demonstrate the event listener isolation
        $event->getArticle()->delete();
    }
}
