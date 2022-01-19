<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\UseCaseTests\TestSpies;

use Kishlin\Backend\RentABike\Bikes\Domain\Bike;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeGateway;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;

final class BikeRepositorySpy implements BikeGateway
{
    /** @var array<string, Bike> */
    private array $bikes = [];

    public function save(Bike $bike): void
    {
        $this->bikes[$bike->bikeId()->value()] = $bike;
    }

    public function findById(BikeId $bikeId): ?Bike
    {
        return $this->bikes[$bikeId->value()] ?? null;
    }

    /**
     * @return string[]
     */
    public function savedBikes(): array
    {
        return array_keys($this->bikes);
    }
}
