<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\UseCaseTests;

use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEvent;
use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Kishlin\Backend\Shared\Domain\Bus\Event\EventDispatcher;

final class TestEventDispatcher implements EventDispatcher
{
    /** @var array<string, DomainEventSubscriber> */
    private array $subscribers = [];

    public function addSubscriber(string $event, DomainEventSubscriber $domainEventSubscriber): void
    {
        $this->subscribers[$event][] = $domainEventSubscriber;
    }

    public function dispatch(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $event) {
            foreach ($this->subscribersForEvent($event) as $subscriber) {
                $subscriber($event);
            }
        }
    }

    private function subscribersForEvent(DomainEvent $event): array
    {
        return $this->subscribers[get_class($event)] ?? [];
    }
}
