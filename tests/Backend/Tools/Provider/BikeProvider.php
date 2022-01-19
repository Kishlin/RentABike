<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Tools\Provider;

use Kishlin\Backend\RentABike\Bikes\Domain\Bike;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeName;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeType;

final class BikeProvider
{
    public static function roadBike(): Bike
    {
        return Bike::create(
            new BikeId('255c03d2-4149-4fe2-b922-65ed3ce4be0e'),
            new BikeType('R'),
            new BikeName('Giant TCR Advanced Pro'),
        );
    }

    public static function gravelBike(): Bike
    {
        return Bike::create(
            new BikeId('9ac1da89-985a-4ab1-a8d6-1bc7173bf44e'),
            new BikeType('G'),
            new BikeName('Canyon Grizl'),
        );
    }

    public static function touringBike(): Bike
    {
        return Bike::create(
            new BikeId('9b089592-35b1-48e2-9e96-03d7c5bb6e55'),
            new BikeType('T'),
            new BikeName('Trek 520'),
        );
    }
}
