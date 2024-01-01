<?php

namespace Common\Events;

use Common\Models\Article;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleStatusChange
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Article $article;
    private string $newStatus;

    public function __construct(Article $article, string $newStatus)
    {
        $this->article = $article;
        $this->newStatus = $newStatus;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    public function setNewStatus(string $status): void
    {
        $this->newStatus = $status;
    }
}
