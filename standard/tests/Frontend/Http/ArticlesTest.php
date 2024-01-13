<?php

namespace Tests\Frontend\Http;

use App\Models\Article;
use Tests\Frontend\TestCase;

class ArticlesTest extends TestCase
{
    /** @test */
    public function it_returns_no_articles()
    {
        $response = $this->json('GET', '/api/articles');
        $response->assertSuccessful();
    }

    /** @test */
    public function it_returns_published_articles_only()
    {
        Article::factory(3)->create(['status' => Article::STATUS_PUBLISHED]);
        Article::factory(2)->create(['status' => Article::STATUS_REJECTED]);
        Article::factory(2)->create(['status' => Article::STATUS_DRAFT]);
        Article::factory(2)->create(['status' => Article::STATUS_REJECTED]);
        $response = $this->json('GET', '/api/articles');
        $this->assertArticleResponse($response, 3);
        $this->assertDatabaseCount('articles', 9);
    }

    /** @test */
    public function it_does_not_return_a_non_published_article()
    {
        $article = Article::factory()->create(['status' => Article::STATUS_REJECTED]);
        $response = $this->json('GET', '/api/articles/' . $article->id);
        $response->assertNotFound();
    }

    /** @test */
    public function it_returns_a_published_article()
    {
        $article = Article::factory()->create(['status' => Article::STATUS_PUBLISHED]);
        $response = $this->json('GET', '/api/articles/' . $article->id);
        $this->assertArticleResponse($response);
    }

    /** @test */
    public function it_does_not_have_any_of_the_backend_routes()
    {
        // not a test you would usually have, but just to test the isolation

        $id = Article::factory()->create()->id;
        $this->json('POST', '/api/articles')->assertMethodNotAllowed();
        $this->json('PATCH', '/api/articles/' . $id . '/delete')->assertNotFound();
        $this->json('PATCH', '/api/articles/' . $id . '/submit')->assertNotFound();
        $this->json('PATCH', '/api/articles/' . $id . '/reject')->assertNotFound();
        $this->json('PATCH', '/api/articles/' . $id . '/publish')->assertNotFound();
        $this->json('DELETE', '/api/articles/' . $id )->assertMethodNotAllowed();
    }

    /** @test **/
    public function it_has_a_health_check_endpoint()
    {
        $this->json('GET', '/health-check')->assertSuccessful();
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
            'created_by',
            'num_views'
        ];

        if ($expectedItems > 1) {
            $response->assertJsonCount($expectedItems, 'data');
            $response->assertJsonStructure(['data' => ['*' => $expectedFields]]);
        } else {
            $response->assertJsonStructure(['data' => $expectedFields]);
        }
    }
}
