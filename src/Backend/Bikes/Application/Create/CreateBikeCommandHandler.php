<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Application\Create;

use Kishlin\Backend\Bikes\Domain\BikeId;
use Kishlin\Backend\Bikes\Domain\BikeName;
use Kishlin\Backend\Bikes\Domain\BikeType;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandHandler;

final class CreateBikeCommandHandler implements CommandHandler
{
    public function __construct(
        private BikeCreator $creator,
    ) {}

    public function __invoke(CreateBikeCommand $command): void
    {
        $this->creator->__invoke(
            new BikeId($command->id()),
            new BikeType($command->type()),
            new BikeName($command->name()),
        );
    }
}
