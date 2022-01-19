<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Application\Create;

use Kishlin\Backend\RentABike\Bikes\Domain\Bike;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeGateway;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandHandler;
use Kishlin\Backend\Shared\Domain\Bus\Event\EventDispatcher;

final class BikeCreator implements CommandHandler
{
    public function __construct(
        private BikeGateway     $gateway,
        private EventDispatcher $bus,
    ) {}

    public function __invoke(CreateBikeCommand $command): Bikeid
    {
        $bike = Bike::create($command->id(), $command->type(), $command->name());

        $this->gateway->save($bike);
        $this->bus->dispatch(...$bike->pullDomainEvents());

        return $bike->bikeId();
    }
}
