<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Infrastructure\Persistence\Doctrine;

use Kishlin\Backend\Bikes\Domain\Bike;
use Kishlin\Backend\Bikes\Domain\BikeGateway;
use Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class BikeRepository extends DoctrineRepository implements BikeGateway
{
    public function save(Bike $bike): void
    {
        $this->persist($bike);
    }
}
