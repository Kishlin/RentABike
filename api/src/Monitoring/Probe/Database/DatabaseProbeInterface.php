<?php

namespace App\Monitoring\Probe\Database;

interface DatabaseProbeInterface
{
    public function isAlive(): bool;
}