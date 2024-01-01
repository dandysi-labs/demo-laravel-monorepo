<?php

namespace Tests\Chores\Feature\Console;

use Tests\Chores\TestCase;
use Tests\HasHealthCheck;

class HealthCheckTest extends TestCase
{
    use HasHealthCheck;
    /** @test */
    public function it_is_successfull()
    {
        $this->assertHealthCheckCommandSuccessful();
    }
}
