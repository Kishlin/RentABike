<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Bus\Event;

use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEvent;
use Kishlin\Backend\Shared\Domain\Bus\Event\EventDispatcher;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBus;

final class InMemoryEventDispatcherUsingSymfony implements EventDispatcher
{
    private MessageBus $bus;

    public function __construct(MessageBus $eventBus)
    {
        $this->bus = $eventBus;
    }

    public function dispatch(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            try {
                $this->bus->dispatch($event);
            } catch (NoHandlerForMessageException) {
            }
        }
    }
}
