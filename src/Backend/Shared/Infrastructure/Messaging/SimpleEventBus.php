<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Messaging;

use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEvent;
use Kishlin\Backend\Shared\Domain\Bus\Event\EventBus;

/**
 * TODO: Eliminate.
 */
final class SimpleEventBus implements EventBus
{
    public function publish(DomainEvent ...$domainEvents): void
    {
    }
}
