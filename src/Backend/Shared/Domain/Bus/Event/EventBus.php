<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain\Bus\Event;

interface EventBus
{
    public function publish(DomainEvent ...$domainEvents): void;
}
