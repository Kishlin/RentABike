<?php

namespace App\Monitoring\Probe;

final class MessagingProbe implements ProbeInterface
{
    public function getName(): string
    {
        return 'messaging';
    }

    public function isAlive(): bool
    {
        return false;
    }
}
