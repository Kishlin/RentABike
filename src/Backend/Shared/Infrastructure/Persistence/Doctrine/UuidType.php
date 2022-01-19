<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Kishlin\Backend\Shared\Domain\Tools;
use Kishlin\Backend\Shared\Domain\ValueObject\UuidValueObject;
use ReflectionException;

abstract class UuidType extends StringType
{
    abstract protected function mappedClass(): string;

    /**
     * @throws ReflectionException
     */
    public function getName(): string
    {
        $shortClassName = Tools::shortClassName($this->mappedClass());

        return Tools::fromPascalToSnakeCase($shortClassName);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UuidValueObject
    {
        $className = $this->mappedClass();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /** @var UuidValueObject $value */
        return $value->value();
    }
}
