<?php

namespace Frontend\Http\Controllers;

use Common\Http\Resources\ArticleResource;
use Common\Models\Article;
use Common\Services\ArticleService;

class ArticleController extends Controller
{
    public function index(ArticleService $articleService)
    {
        return ArticleResource::collection($articleService->published());
    }

    public function show(Article $article)
    {
        abort_if(Article::STATUS_PUBLISHED !== $article->status, 404);
        return new ArticleResource($article);
    }
}
