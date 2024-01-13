<?php

namespace Tests\Frontend\Http;

use Tests\Frontend\TestCase;

class InfoTest extends TestCase
{
    /** @test */
    public function it_returns_info()
    {
        $response = $this->json('GET', '/api');
        $response->assertSuccessful();
        $response->assertJsonPath('data', 'This is the Frontend API');
    }
}
