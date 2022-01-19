<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Domain\Bus\Message;

use Kishlin\Backend\Shared\Domain\Bus\Message\Mapping;
use Kishlin\Tests\Backend\Tools\ReflectionHelper;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionMethod;

final class MappingTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testGetStringReturnsEmptyStringIfKeyIsMissing(): void
    {
        $key    = 'missing-key';
        $source = [];

        $this->assertEquals('', ReflectionHelper::invoke($this->object(), 'getString', $source, $key));
    }

    /**
     * @throws ReflectionException
     */
    public function testGetStringCastsValue(): void
    {
        $key    = 'key';
        $source = [ $key => 1 ];

        $value = ReflectionHelper::invoke($this->object(), 'getString', $source, $key);

        $this->assertIsString($value);
        $this->assertEquals('1', $value);
    }

    private function object(): MockObject
    {
        return $this->getMockForTrait(Mapping::class);
    }
}
