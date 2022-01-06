<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain;

interface UuidGenerator
{
    public function generate(): string;
}
