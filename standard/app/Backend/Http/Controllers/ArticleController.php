<?php

namespace App\Backend\Http\Controllers;

use App\Backend\Requests\CreateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        return ArticleResource::collection($this->articleService->all());
    }

    public function delete(Article $article)
    {
        $this->articleService->delete($article);
        return response()->noContent();
    }

    public function create(CreateArticleRequest $request)
    {
        return new ArticleResource($this->articleService->create($request->validated()));
    }

    public function submit(Article $article)
    {
        $this->articleService->submit($article);
        return new ArticleResource($article);
    }

    public function publish(Article $article)
    {
        $this->articleService->publish($article);
        return new ArticleResource($article);
    }

    public function reject(Article $article)
    {
        $this->articleService->reject($article);
        return new ArticleResource($article);
    }

    public function show(Article $article)
    {
        return new ArticleResource($article);
    }
}
