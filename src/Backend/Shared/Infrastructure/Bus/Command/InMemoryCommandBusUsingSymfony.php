<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Bus\Command;


use Kishlin\Backend\Shared\Domain\Bus\Command\Command;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

final class InMemoryCommandBusUsingSymfony implements CommandBus
{
    private MessageBus $bus;

    public function __construct(MessageBus $commandBus)
    {
        $this->bus = $commandBus;
    }

    /**
     * @throws Throwable
     */
    public function execute(Command $command): object
    {
        try {
            $stamp = $this->bus->dispatch($command)->last(HandledStamp::class);
            assert($stamp instanceof HandledStamp);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException) {
            throw new CommandNotRegisteredError($command);
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious() ?? $error;
        }
    }
}
