<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\UseCaseTests;

use Kishlin\Backend\RentABike\Bikes\Application\Create\BikeCreator;
use Kishlin\Tests\Backend\UseCaseTests\TestSpies\BikeRepositorySpy;

final class TestServiceContainer
{
    private ?TestCommandBus $testCommandBus = null;

    private ?TestEventDispatcher $testEventDispatcher = null;

    private ?BikeCreator $bikeCreator = null;

    private ?BikeRepositorySpy $bikeRepositorySpy = null;

    public function commandBus(): TestCommandBus
    {
        if (null === $this->testCommandBus) {
            $this->testCommandBus = new TestCommandBus($this);
        }

        return $this->testCommandBus;
    }

    public function eventDispatcher(): TestEventDispatcher
    {
        if (null === $this->testEventDispatcher) {
            $this->testEventDispatcher = new TestEventDispatcher();
        }

        return $this->testEventDispatcher;
    }

    public function bikeCreator():BikeCreator
    {
        if (null === $this->bikeCreator) {
            $this->bikeCreator = new BikeCreator($this->bikeRepository(), $this->eventDispatcher());
        }

        return $this->bikeCreator;
    }

    public function bikeRepository(): BikeRepositorySpy
    {
        if (null === $this->bikeRepositorySpy)  {
            $this->bikeRepositorySpy = new BikeRepositorySpy();
        }

        return $this->bikeRepositorySpy;
    }
}
