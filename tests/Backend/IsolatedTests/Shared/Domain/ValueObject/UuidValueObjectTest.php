<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Kishlin\Backend\Shared\Domain\ValueObject\UuidValueObject;
use PHPUnit\Framework\TestCase;

final class UuidValueObjectTest extends TestCase
{
    public function testItCanBeCreatedAndConvertedBackToString(): void
    {
        $uuid = '51cefa3e-c223-469e-a23c-61a32e4bf048';

        self::assertEquals(
            $uuid,
            (new class($uuid) extends UuidValueObject {})->value(),
        );
    }

    public function testItValidatesInput(): void
    {
        $uuid = 'invalid uuid';

        self::expectException(InvalidArgumentException::class);
        new class($uuid) extends UuidValueObject {};
    }
}
