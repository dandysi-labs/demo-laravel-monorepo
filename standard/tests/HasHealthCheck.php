<?php

namespace Tests;

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
        $this->artisan('app:health-check')->assertSuccessful();
    }
}
