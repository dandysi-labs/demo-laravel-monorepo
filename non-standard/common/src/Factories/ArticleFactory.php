<?php

namespace Common\Factories;

use Common\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Common\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'headline' => fake()->name(),
            'content' => fake()->sentence(245),
            'status' => fake()->randomElement(Article::STATUSES),
            'priority' => Article::PRIORITY_NORMAL,
            'author' => fake()->randomElement(Article::AUTHORS),
            'category' => fake()->randomElement(Article::CATEGORIES),
            'created_by' => 'test'
        ];
    }
}
