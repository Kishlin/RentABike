<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Application\Create;

use Kishlin\Backend\Bikes\Domain\Bike;
use Kishlin\Backend\Bikes\Domain\BikeGateway;
use Kishlin\Backend\Bikes\Domain\BikeId;
use Kishlin\Backend\Bikes\Domain\BikeName;
use Kishlin\Backend\Bikes\Domain\BikeType;
use Kishlin\Backend\Shared\Domain\Bus\Event\EventBus;

final class BikeCreator
{
    public function __construct(
        private BikeGateway $gateway,
        private EventBus $bus,
    ) {}

    public function __invoke(BikeId $bikeId, BikeType $bikeType, BikeName $bikeName): void
    {
        $bike = Bike::create($bikeId, $bikeType, $bikeName);

        $this->gateway->save($bike);
        $this->bus->publish(...$bike->pullDomainEvents());
    }
}
