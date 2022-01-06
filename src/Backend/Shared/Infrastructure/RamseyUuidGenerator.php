<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure;

use Kishlin\Backend\Shared\Domain\UuidGenerator;
use Ramsey\Uuid\Uuid;

class RamseyUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
