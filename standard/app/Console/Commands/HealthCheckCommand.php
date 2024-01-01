<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HealthCheckCommand extends Command
{
    protected $name = 'app:health-check';

    protected $description = 'Simple health check';

    public function handle(): void
    {
        $this->info('Everything is ok!');
    }
}
