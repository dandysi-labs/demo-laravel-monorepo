<?php

namespace Common\Console\Commands;

use Illuminate\Console\Command;

class HealthCheckCommand extends Command
{
    protected $name = 'common:health-check';

    protected $description = 'Simple health check';

    public function handle(): void
    {
        $this->info('Everything is ok!');
    }
}
