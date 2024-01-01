<?php

namespace Tests\Chores\Feature\Console;

use App\Models\Article;
use Tests\Chores\TestCase;

class CreateArticleTest extends TestCase
{
    /** @test */
    public function it_creates_an_article()
    {
        $this->artisan('chores:create_article')->assertSuccessful();
        $this->assertDatabaseHas('articles', [
            'status' => Article::STATUS_DRAFT,
            'created_by' => 'Chores'
        ]);
    }

    /**
     * @test
     * @dataProvider getCreateByArticleData
     */
    public function it_creates_an_article_with_a_specified_category(string $category, int $expectedPriority)
    {
        $this->artisan('chores:create_article ' . $category)->assertSuccessful();
        $this->assertDatabaseHas('articles', [
            'status' => Article::STATUS_DRAFT,
            'created_by' => 'Chores',
            'priority' => $expectedPriority
        ]);
    }

    public static function getCreateByArticleData()
    {
        return [
            [Article::CATEGORY_OTHER, Article::PRIORITY_NORMAL],
            [Article::CATEGORY_SYMFONY, Article::PRIORITY_NORMAL],
            [Article::CATEGORY_LARAVEL, Article::PRIORITY_HIGH],
        ];
    }
}
