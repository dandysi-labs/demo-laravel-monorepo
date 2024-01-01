<?php

namespace Tests\Backend\Feature\Http;

use App\Models\Article;
use Tests\Backend\TestCase;

class ArticlesTest extends TestCase
{
    /** @test */
    public function it_returns_articles()
    {
        $numArticles = 5;
        Article::factory($numArticles)->create();
        $response = $this->json('GET', '/api/articles');
        $this->assertArticleResponse($response, $numArticles);
    }

    /**
     * @test
     * @dataProvider getSubmitData
     */
    public function it_can_submit_an_article(string $author, string $category, string $expectedStatus)
    {
        $article = Article::factory()->create([
            'status' => Article::STATUS_DRAFT,
            'author' => $author,
            'category' => $category
        ]);
        $id = $article->id;
        $response = $this->json('PATCH', '/api/articles/' . $id. '/submit');
        $this->assertDatabaseHas('articles', ['id' => $id, 'status' => $expectedStatus]);
        $this->assertArticleResponse($response);
    }

    public static function getSubmitData()
    {
        return [
            [Article::AUTHOR_GEOFF, Article::CATEGORY_SYMFONY, Article::STATUS_PUBLISHED], //gets auto published
            [Article::AUTHOR_STEVE, Article::CATEGORY_LARAVEL, Article::STATUS_SUBMITTED],
            [Article::AUTHOR_DAVE, Article::CATEGORY_SYMFONY, Article::STATUS_SUBMITTED],
            [Article::AUTHOR_GEOFF, Article::CATEGORY_OTHER, Article::STATUS_PUBLISHED], //gets auto published
            [Article::AUTHOR_STEVE, Article::CATEGORY_OTHER, Article::STATUS_REJECTED],
            [Article::AUTHOR_DAVE, Article::CATEGORY_OTHER, Article::STATUS_REJECTED],
        ];
    }

    /** @test */
    public function it_can_submit_an_article_by_geoff_and_auto_publish()
    {
        $article = Article::factory()->create([
            'status' => Article::STATUS_DRAFT,
            'author' => Article::AUTHOR_GEOFF,
        ]);
        $id = $article->id;
        $response = $this->json('PATCH', '/api/articles/' . $id. '/submit');
        $this->assertDatabaseHas('articles', ['id' => $id, 'status' => Article::STATUS_PUBLISHED]);
        $this->assertArticleResponse($response);
    }

    /** @test */
    public function it_can_delete_a_non_laravel_article()
    {
        $article = Article::factory()->create(['category' => Article::CATEGORY_OTHER]);
        $id = $article->id;
        $response = $this->json('DELETE', '/api/articles/' . $id);
        $this->assertDatabaseMissing('articles', ['id' => $id]);
        $response->assertSuccessful();
        $response->assertNoContent();
    }

    /** @test */
    public function it_cannot_delete_a_laravel_article()
    {
        $article = Article::factory()->create(['category' => Article::CATEGORY_LARAVEL]);
        $id = $article->id;
        $response = $this->json('DELETE', '/api/articles/' . $id);
        $this->assertDatabaseHas('articles', ['id' => $id]);
        $response->assertStatus(403);
    }

    /**
     * @test
     * @dataProvider getCreateInvalidData
     */
    public function it_fails_validation_when_creating_an_article(array $data)
    {
        $response = $this->json('POST', '/api/articles', $data);
        $response->assertStatus(422);
    }

    public static function getCreateInvalidData()
    {
        yield [[]];

        yield [[
            'headline' => 'An interesting article',
            'content' => 'Something',
            'author' => Article::AUTHOR_DAVE,
            'category' => 'ASP.NET'
        ]];

        yield [[
            'headline' => 'An interesting article',
            'content' => 'Something',
            'author' => 'Brian',
            'category' => Article::CATEGORY_SYMFONY
        ]];
    }

    /**
     * @test
     * @dataProvider getCreateData
     */
    public function it_can_create_an_article(string $category, int $expectedPriority)
    {
        $data = [
            'category' => $category,
            'author' => Article::AUTHOR_DAVE,
            'headline' => fake()->paragraph(),
            'content'=> fake()->paragraph(),
        ];

        $response = $this->json('POST', '/api/articles', $data);

        $expectedData = $data;
        //global prioritise listener
        $expectedData['priority'] = $expectedPriority;
        // backend specific listener
        $expectedData['created_by'] = 'Backend';

        $this->assertDatabaseHas('articles', $expectedData);
        $this->assertArticleResponse($response);
    }

    /** @test **/
    public function it_returns_an_article()
    {
        $article = Article::factory()->create(['status' => Article::STATUS_REJECTED]);
        $response = $this->json('GET', '/api/articles/' . $article->id);
        $this->assertArticleResponse($response);
    }

    /** @test **/
    public function it_has_a_health_check_endpoint()
    {
        $this->json('GET', '/health-check')->assertSuccessful();
    }

    public static function getCreateData()
    {
        return [
            [Article::CATEGORY_LARAVEL, Article::PRIORITY_HIGH],
            [Article::CATEGORY_SYMFONY, Article::PRIORITY_NORMAL],
            [Article::CATEGORY_OTHER, Article::PRIORITY_NORMAL]
        ];
    }

    private function assertArticleResponse(mixed $response, int $expectedItems = 1)
    {
        $response->assertSuccessful();

        $expectedFields = [
            'id',
            'content',
            'headline',
            'status',
            'category',
            'author',
            'priority',
            'created_at',
            'created_by'
        ];

        if ($expectedItems > 1) {
            $response->assertJsonCount($expectedItems, 'data');
            $response->assertJsonStructure(['data' => ['*' => $expectedFields]]);
        } else {
            $response->assertJsonStructure(['data' => $expectedFields]);
        }
    }
}
