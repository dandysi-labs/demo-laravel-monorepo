<?php

namespace App\Services;

use App\Events\ArticleCreate;
use App\Events\ArticleDelete;
use App\Events\ArticleStatusChange;
use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    public function all(): Collection
    {
        return Article::all();
    }

    public function published(): Collection
    {
        return Article::where(['status' => Article::STATUS_PUBLISHED])
            ->get()
        ;
    }

    public function delete(Article $article): void
    {
        ArticleDelete::dispatch($article);
        $article->delete();
    }

    public function generate(string $category=null): Article
    {
        $faker = Factory::create();

        $article = Article::make([
            'headline' => $faker->name(),
            'content' => $faker->paragraph(),
            'status' => Article::STATUS_DRAFT,
            'priority' => Article::PRIORITY_NORMAL,
            'author' => $faker->randomElement(Article::AUTHORS),
            'category' => $category ?: $faker->randomElement(Article::CATEGORIES)
        ]);

        ArticleCreate::dispatch($article);
        $article->save();
        return $article;
    }

    public function create(array $data): Article
    {
        $data['status'] = Article::STATUS_DRAFT;
        $data['priority'] = Article::PRIORITY_NORMAL;
        $article = Article::make($data);
        ArticleCreate::dispatch($article);
        $article->save();
        return $article;
    }

    private function setStatus(Article $article, string $status): void
    {
        $allowedMappings = [
            Article::STATUS_DRAFT => [Article::STATUS_SUBMITTED],
            Article::STATUS_SUBMITTED => [Article::STATUS_REJECTED, Article::STATUS_PUBLISHED]
        ];

        if (!in_array($status, $allowedMappings[$article->status])) {
            abort(422, 'Invalid Status');
        }

        $event = new ArticleStatusChange($article, $status);
        event($event);
        $article->status = $event->getNewStatus();
        $article->save();
    }

    public function submit(Article $article): void
    {
        $this->setStatus($article, Article::STATUS_SUBMITTED);
    }

    public function reject(Article $article): void
    {
        $this->setStatus($article, Article::STATUS_REJECTED);
    }

    public function publish(Article $article): void
    {
        $this->setStatus($article, Article::STATUS_PUBLISHED);
    }
}
