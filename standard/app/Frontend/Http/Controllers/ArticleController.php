<?php

namespace App\Frontend\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;

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
