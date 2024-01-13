<?php

namespace Tests\Backend\Feature\Http;

use Tests\Backend\TestCase;

class InfoTest extends TestCase
{
    /** @test */
    public function it_returns_info()
    {
        $response = $this->json('GET', '/api');
        $response->assertSuccessful();
        $response->assertJsonPath('data', 'This is the Backend API');
    }
}
