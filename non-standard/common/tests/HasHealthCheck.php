<?php

namespace Tests\Common;

trait HasHealthCheck
{
    public function assertHealthCheckEndpointSuccessful(): void
    {
        $response = $this->getJson('/health-check');
        $response->assertSuccessful();
        $response->assertExactJson(['data'=>'ok']);
    }

    public function assertHealthCheckCommandSuccessful(): void
    {
        $this->artisan('common:health-check')->assertSuccessful();
    }
}
