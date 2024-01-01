<?php

namespace Common\Events;

use Common\Models\Article;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}
