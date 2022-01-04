<?php

namespace App\Monitoring\Probe;

interface ProbeInterface
{
    public function getName(): string;

    public function isAlive(): bool;
}
