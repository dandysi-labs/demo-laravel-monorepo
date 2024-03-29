<?php

namespace Tests\Frontend;

use App\Frontend\MonorepoProvider;
use Dandysi\Laravel\Monorepo\MonorepoProvider as BaseMonorepoProvider;
use Tests\TestCase as BaseTestCase;

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
