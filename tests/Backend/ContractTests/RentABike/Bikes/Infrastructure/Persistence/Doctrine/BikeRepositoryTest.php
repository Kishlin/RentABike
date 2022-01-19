<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\ContractTests\RentABike\Bikes\Infrastructure\Persistence\Doctrine;

use Kishlin\Backend\RentABike\Bikes\Domain\Bike;
use Kishlin\Backend\RentABike\Bikes\Infrastructure\Persistence\Doctrine\BikeRepository;
use Kishlin\Tests\Backend\Tools\Provider\BikeProvider;
use Kishlin\Tests\Backend\Tools\Test\RepositoryContractTestCase;

class BikeRepositoryTest extends RepositoryContractTestCase
{
    /**
     * @dataProvider bikeProvider
     */
    public function testItCanSaveABike(Bike $bike): void
    {
        $repository = new BikeRepository(static::entityManager());

        $repository->save($bike);

        /** @var Bike $savedBike */
        $savedBike = static::entityManager()->getRepository(Bike::class)->find($bike->bikeId());

        self::assertEquals($bike, $savedBike);
    }

    public function bikeProvider(): iterable
    {
        yield [ BikeProvider::roadBike() ];

        yield [ BikeProvider::gravelBike() ];

        yield [ BikeProvider::touringBike() ];
    }
}
