<?php

namespace Tests\Chores\Feature\Console;

use App\Models\Article;
use Tests\Chores\TestCase;

class PurgeArticlesTest extends TestCase
{
    /** @test */
    public function it_deletes_all_articles()
    {
        Article::factory(10)->create();
        $this->artisan('chores:purge_articles')->assertSuccessful();
        $this->assertDatabaseCount('articles', 0);
    }
}
