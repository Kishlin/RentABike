<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain;

use Kishlin\Backend\Shared\Domain\Tools;
use PHPUnit\Framework\TestCase;
use ReflectionException;

final class ToolsTest extends TestCase
{
    public function testEndsWith(): void
    {
        self::assertTrue(Tools::endsWith('123456789', ''));
        self::assertTrue(Tools::endsWith('123456789', '9'));
        self::assertTrue(Tools::endsWith('123456789', '789'));
        self::assertTrue(Tools::endsWith('123456789', '123456789'));

        self::assertFalse(Tools::endsWith('123456789', '1'));
        self::assertFalse(Tools::endsWith('123456789', '0'));
    }

    public function testFromCamelToSnakeCaseTest(): void
    {
        self::assertEquals('string', Tools::fromPascalToSnakeCase('string'));

        self::assertEquals('short_string', Tools::fromPascalToSnakeCase('shortString'));

        self::assertEquals('this_is_a_long_string', Tools::fromPascalToSnakeCase('ThisIsALongString'));
    }

    /**
     * @throws ReflectionException
     */
    public function testShortClassName(): void
    {
        self::assertEquals('ToolsTest', Tools::shortClassName(self::class));
        self::assertEquals('ToolsTest', Tools::shortClassName($this));

        self::expectException(ReflectionException::class);
        Tools::shortClassName('invalid');
    }
}
