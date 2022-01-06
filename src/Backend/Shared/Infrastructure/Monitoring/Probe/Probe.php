<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Monitoring\Probe;

interface Probe
{
    public function name(): string;

    public function isAlive(): bool;
}
