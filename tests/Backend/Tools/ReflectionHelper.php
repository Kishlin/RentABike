<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Tools;

use ReflectionException;
use ReflectionMethod;

final class ReflectionHelper
{
    /**
     * @throws ReflectionException
     */
    public static function invoke(object $subject, string $method, mixed ...$args): mixed
    {
        $reflectionMethod = new ReflectionMethod($subject, $method);

        return $reflectionMethod->invoke($subject, ...$args);
    }
}
