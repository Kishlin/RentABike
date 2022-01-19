<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain\Bus\Event;

use Kishlin\Backend\Shared\Domain\ValueObject\UuidValueObject;

abstract class DomainEvent
{
    public function __construct(
        private UuidValueObject $aggregateUuid,
    ) {}

    abstract public static function eventName(): string;

    public function aggregateUuid(): UuidValueObject
    {
        return $this->aggregateUuid;
    }
}
