<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain\Bus\Event;

abstract class DomainEvent
{
    public function __construct(
        private string  $aggregateUuid,
        private ?string $eventUuid,
        private ?string $occurredOn,
    ) {}

    abstract public static function eventName(): string;

    public function aggregateUuid(): string
    {
        return $this->aggregateUuid;
    }

    public function eventUuid(): ?string
    {
        return $this->eventUuid;
    }

    public function occurredOn(): ?string
    {
        return $this->occurredOn;
    }
}
