<?php

namespace Tests\Frontend\Http;

use Tests\Frontend\TestCase;
use Tests\HasHealthCheck;

class HealthCheckTest extends TestCase
{
    use HasHealthCheck;

    /** @test */
    public function it_returns_ok()
    {
        $this->assertHealthCheckEndpointSuccessful();
    }
}
