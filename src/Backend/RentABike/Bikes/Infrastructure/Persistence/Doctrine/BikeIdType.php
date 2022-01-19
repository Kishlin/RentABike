<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Infrastructure\Persistence\Doctrine;

use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class BikeIdType extends UuidType
{
    protected function mappedClass(): string
    {
        return BikeId::class;
    }
}
