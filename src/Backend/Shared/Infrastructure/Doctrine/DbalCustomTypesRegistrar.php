<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Doctrine;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\Type;
use Kishlin\Backend\Shared\Domain\Tools;
use ReflectionException;

final class DbalCustomTypesRegistrar
{
    private static bool $initialized = false;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function register(array $customTypeClassNames): void
    {
        if (true === self::$initialized) {
            return;
        }

        foreach ($customTypeClassNames as $typeClassName) {
            $shortClassName = Tools::shortClassName($typeClassName);
            $trimmedName    = substr($shortClassName, 0, strlen($shortClassName) - 4);
            $typeName       = Tools::fromPascalToSnakeCase($trimmedName);

            Type::addType($typeName, $typeClassName);
        }

        self::$initialized = true;
    }
}
