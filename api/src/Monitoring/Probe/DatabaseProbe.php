<?php

namespace App\Monitoring\Probe;

final class DatabaseProbe implements ProbeInterface
{
    public function getName(): string
    {
        return 'database';
    }

    public function isAlive(): bool
    {
        return false;
    }
}
