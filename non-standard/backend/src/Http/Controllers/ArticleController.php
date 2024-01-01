<?php

namespace Backend\Http\Controllers;

use Backend\Requests\CreateArticleRequest;
use Common\Http\Resources\ArticleResource;
use Common\Models\Article;
use Common\Services\ArticleService;

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
