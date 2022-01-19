<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Domain;

use Kishlin\Backend\Shared\Domain\Aggregate\AggregateRoot;

final class Bike extends AggregateRoot
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
            $bike->bikeId,
            $bike->bikeType,
            $bike->bikeName,
        ));

        return $bike;
    }

    public function bikeId(): BikeId
    {
        return $this->bikeId;
    }
}
