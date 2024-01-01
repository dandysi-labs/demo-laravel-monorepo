<?php

namespace Tests\Backend;

use Backend\MonorepoProvider;
use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Tests\Common\TestCase as BaseTestCase;
class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        putenv(BaseMonorepoProvider::PROVIDER_ENV . '='.MonorepoProvider::class);
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        putenv(BaseMonorepoProvider::PROVIDER_ENV);
    }
}
