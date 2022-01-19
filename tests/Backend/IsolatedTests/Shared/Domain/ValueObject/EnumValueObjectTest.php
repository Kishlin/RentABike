<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Kishlin\Backend\Shared\Domain\ValueObject\EnumValueObject;
use PHPUnit\Framework\TestCase;

final class EnumValueObjectTest extends TestCase
{
    public function testItCanBeCreatedAndConvertedBackToEnum(): void
    {
        $string = 'rentabike';

        $valueObject = new class($string) extends EnumValueObject {
            protected function possibleValues(): array
            {
                return ['rentabike'];
            }
        };

        self::assertEquals($string, $valueObject->value());
    }
    public function testItValidatesValueIsAcceptable(): void
    {
        $string = 'invalid';

        self::expectException(InvalidArgumentException::class);
        $valueObject = new class($string) extends EnumValueObject {
            protected function possibleValues(): array
            {
                return ['rentabike'];
            }
        };
    }
}
