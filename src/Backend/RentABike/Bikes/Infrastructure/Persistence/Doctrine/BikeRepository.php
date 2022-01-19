<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Infrastructure\Persistence\Doctrine;

use Kishlin\Backend\RentABike\Bikes\Domain\Bike;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeGateway;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class BikeRepository extends DoctrineRepository implements BikeGateway
{
    public function save(Bike $bike): void
    {
        $this->persist($bike);
    }

    public function findById(BikeId $bikeId): ?Bike
    {
        return $this->entityManager->getRepository(Bike::class)->find($bikeId->value());
    }
}
