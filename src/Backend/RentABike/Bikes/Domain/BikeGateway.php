<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Domain;

interface BikeGateway
{
    public function save(Bike $bike): void;

    public function findById(BikeId $bikeId): ?Bike;
}
