<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain;

use ReflectionClass;
use ReflectionException;

final class Tools
{
    public static function endsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);
        if ($length === 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    public static function fromPascalToSnakeCase(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    /**
     * @throws ReflectionException
     */
    public static function shortClassName(object|string $objectOrClass): string
    {
        $reflectionClass = new ReflectionClass($objectOrClass);

        return $reflectionClass->getShortName();
    }
}
