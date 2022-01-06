<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Kishlin\Backend\Shared\Domain\ValueObject\UuidValueObject;

abstract class UuidType extends StringType
{
    abstract protected function typeName(): string;

    public function getName(): string
    {
        return $this->typeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UuidType
    {
        $className = static::class;

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /** @var UuidValueObject $value */
        return $value->value();
    }
}
