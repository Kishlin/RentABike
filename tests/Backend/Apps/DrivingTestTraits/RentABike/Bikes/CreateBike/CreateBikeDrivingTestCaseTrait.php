<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Apps\DrivingTestTraits\RentABike\Bikes\CreateBike;

use Kishlin\Backend\RentABike\Bikes\Application\Create\CreateBikeCommand;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;

trait CreateBikeDrivingTestCaseTrait
{
    public function getConfiguredBusMock(string $type, string $name): CommandBus
    {
        $commandClass = CreateBikeCommand::class;

        $bus = $this->getMockForAbstractClass(CommandBus::class);
        $bus->expects($this->once())->method('execute')->with(
            $this->callback(static function(object $parameter) use($type, $name, $commandClass) {
                return $parameter instanceof $commandClass &&
                    $type === $parameter->type()->value() &&
                    $name === $parameter->name()->value()
                ;
            })
        )->willReturnCallback(
            static fn(CreateBikeCommand $command) => $command->id()
        );

        return $bus;
    }
}
