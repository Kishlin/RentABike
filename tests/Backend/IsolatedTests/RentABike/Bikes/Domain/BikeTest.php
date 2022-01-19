<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\RentABike\Bikes\Domain;

use Kishlin\Backend\RentABike\Bikes\Domain\Bike;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeCreatedDomainEvent;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeName;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeType;
use PHPUnit\Framework\TestCase;

final class BikeTest extends TestCase
{
    public function testItCanBeCreated(): void
    {
        $bikeId   = new BikeId('51cefa3e-c223-469e-a23c-61a32e4bf048');
        $bikeType = new BikeType('R');
        $bikeName = new BikeName('Giant TCR Advanced Pro 2');

        $bike = Bike::create($bikeId, $bikeType, $bikeName);

        self::assertContainsEquals(
            new BikeCreatedDomainEvent($bikeId, $bikeType, $bikeName),
            $bike->pullDomainEvents(),
        );
    }
}
