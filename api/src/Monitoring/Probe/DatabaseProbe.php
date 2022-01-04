<?php

namespace App\Monitoring\Probe;

use App\Monitoring\Probe\Database\DatabaseProbeInterface;

final class DatabaseProbe implements ProbeInterface
{
    public function __construct(
        private DatabaseProbeInterface $probe
    )
    { }

    public function getName(): string
    {
        return 'database';
    }

    public function isAlive(): bool
    {
        return $this->probe->isAlive();
    }
}
