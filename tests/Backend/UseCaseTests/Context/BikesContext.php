<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\UseCaseTests\Context;

use Behat\Behat\Context\Context;
use Kishlin\Backend\RentABike\Bikes\Application\Create\CreateBikeCommand;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Tests\Backend\UseCaseTests\TestServiceContainer;
use PHPUnit\Framework\Assert;

final class BikesContext implements Context
{
    private ?BikeId $bikeId = null;

    public function __construct(
        private TestServiceContainer $container = new TestServiceContainer()
    ) {}

    /**
     * @When /^a client creates a bike$/
     */
    public function aClientCreatesABike(): void
    {
        $this->bikeId = $this->container->commandBus()->execute(
            CreateBikeCommand::fromScalars('51cefa3e-c223-469e-a23c-61a32e4bf048', 'R', 'Giant TCR Advanced Pro 2')
        );
    }

    /**
     * @Then /^the bike should be persisted$/
     */
    public function theBikeShouldBePersisted(): void
    {
        Assert::assertInstanceOf(BikeId::class, $this->bikeId);

        Assert::assertContainsEquals(
            $this->bikeId->value(),
            $this->container->bikeRepository()->savedBikes()
        );
    }
}
