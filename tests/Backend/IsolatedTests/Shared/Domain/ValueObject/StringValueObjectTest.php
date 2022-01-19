<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain\ValueObject;

use Kishlin\Backend\Shared\Domain\ValueObject\StringValueObject;
use PHPUnit\Framework\TestCase;

final class StringValueObjectTest extends TestCase
{
    public function testItCanBeCreatedAndConvertedBackToString(): void
    {
        $string = 'rentabike';

        self::assertEquals(
            $string,
            (new class($string) extends StringValueObject {})->value(),
        );
    }
}
