<?php

namespace App\Chores\Listeners;

use App\Events\ArticleCreate;

class AssignCreatedByListener
{
    public function handle(ArticleCreate $event): void
    {
        $event->getArticle()->created_by = 'Chores';
    }
}
