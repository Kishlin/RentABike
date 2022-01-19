<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain\Aggregate;

use Kishlin\Backend\Shared\Domain\Aggregate\AggregateRoot;
use Kishlin\Backend\Shared\Domain\Bus\Event\DomainEvent;
use Kishlin\Backend\Shared\Domain\ValueObject\UuidValueObject;
use Kishlin\Tests\Backend\Tools\ReflectionHelper;
use PHPUnit\Framework\TestCase;
use ReflectionException;

final class AggregateRootTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testItCanRecordAndPullEvents(): void
    {
        $root  = new class extends AggregateRoot {};

        $event = new class(
            new class('51cefa3e-c223-469e-a23c-61a32e4bf048') extends UuidValueObject {}
        ) extends DomainEvent {
            public static function eventName(): string
            {
                return 'event.test';
            }
        };

        $this->assertEmpty($root->pullDomainEvents());

        ReflectionHelper::invoke($root, 'record', $event);
        $this->assertContainsEquals($event, $root->pullDomainEvents());
        $this->assertEmpty($root->pullDomainEvents());
    }
}
