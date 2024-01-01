<?php

namespace Tests\Backend\Feature\Http;

use Tests\Backend\TestCase;
use Tests\Common\HasHealthCheck;

class HealthCheckTest extends TestCase
{
    use HasHealthCheck;

    /** @test */
    public function it_returns_ok()
    {
        $this->assertHealthCheckEndpointSuccessful();
    }
}
