<?php

namespace Chores\Listeners;

use Common\Events\ArticleCreate;

class AssignCreatedByListener
{
    public function handle(ArticleCreate $event): void
    {
        $event->getArticle()->created_by = 'Chores';
    }
}
