<?php

namespace Backend\Listeners;

use Common\Events\ArticleCreate;

class AssignCreatedByListener
{
    public function handle(ArticleCreate $event): void
    {
        $event->getArticle()->created_by = 'Backend';
    }
}
