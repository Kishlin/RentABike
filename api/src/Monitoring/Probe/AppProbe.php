<?php

namespace App\Monitoring\Probe;

final class AppProbe implements ProbeInterface
{
    public function getName(): string
    {
        return 'app';
    }

    public function isAlive(): bool
    {
        return true;
    }
}
