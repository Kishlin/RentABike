<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Domain;

use Kishlin\Backend\Shared\Domain\Aggregate\AggregateRoot;

class Bike extends AggregateRoot
{
    private function __construct(
        private BikeId $bikeId,
        private BikeType $bikeType,
        private BikeName $bikeName,
    ) {}

    public static function create(BikeId $bikeId, BikeType $bikeType, BikeName $bikeName): self
    {
        $bike = new self($bikeId, $bikeType, $bikeName);

        $bike->record(new BikeCreatedDomainEvent(
            $bikeId->value(),
            $bikeType->value(),
            $bikeName->value(),
            null,
            null
        ));

        return $bike;
    }

    public function bikeId(): BikeId
    {
        return $this->bikeId;
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
