<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Domain;

use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEvent;

final class BikeCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string  $bikeId,
        private string $bikeType,
        private string $bikeName,
        ?string $eventUuid,
        ?string $occurredOn
    ) {
        parent::__construct($bikeId, $eventUuid, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'bike.created';
    }

    public function bikeId(): string
    {
        return $this->aggregateUuid();
    }

    public function bikeType(): string
    {
        return $this->bikeType;
    }

    public function bikeName(): string
    {
        return $this->bikeName;
    }
}
