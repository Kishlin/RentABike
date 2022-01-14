<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Messaging;

use Kishlin\Backend\Shared\Domain\Bus\Command\Command;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * TODO: Eliminate.
 */
final class SimpleCommandBus implements CommandBus
{
    public function __construct(
        private ContainerInterface $serviceContainer
    ) {}

    public function dispatch(Command $command): void
    {
        /** @var callable $handler */
        $handler = $this->serviceContainer->get(get_class($command) . 'Handler');
        $handler($command);
    }
}
