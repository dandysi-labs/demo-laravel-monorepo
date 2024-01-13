<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'headline' => fake()->text(Article::MAX_LENGTH_HEADLINE),
            'content' => fake()->text(Article::MAX_LENGTH_CONTENT),
            'status' => fake()->randomElement(Article::STATUSES),
            'priority' => Article::PRIORITY_NORMAL,
            'author' => fake()->randomElement(Article::AUTHORS),
            'category' => fake()->randomElement(Article::CATEGORIES),
            'created_by' => 'test'
        ];
    }
}
