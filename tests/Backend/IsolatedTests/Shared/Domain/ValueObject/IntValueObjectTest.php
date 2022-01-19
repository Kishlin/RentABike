<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain\ValueObject;

use Kishlin\Backend\Shared\Domain\ValueObject\IntValueObject;
use PHPUnit\Framework\TestCase;

final class IntValueObjectTest extends TestCase
{
    public function testItCanBeCreatedAndConvertedBackToInt(): void
    {
        $Int = 42;

        self::assertEquals(
            $Int,
            (new class($Int) extends IntValueObject {})->value(),
        );
    }
}
