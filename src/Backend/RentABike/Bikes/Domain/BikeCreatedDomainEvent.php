<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Domain;

use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEvent;
use Kishlin\Backend\Shared\Domain\ValueObject\UuidValueObject;

final class BikeCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        BikeId $bikeId,
        private BikeType $bikeType,
        private BikeName $bikeName,
    ) {
        parent::__construct($bikeId);
    }

    public static function eventName(): string
    {
        return 'bike.created';
    }

    public function bikeId(): UuidValueObject
    {
        return $this->aggregateUuid();
    }

    public function bikeType(): BikeType
    {
        return $this->bikeType;
    }

    public function bikeName(): BikeName
    {
        return $this->bikeName;
    }
}
