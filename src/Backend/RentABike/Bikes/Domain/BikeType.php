<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Domain;

use Kishlin\Backend\Shared\Domain\ValueObject\EnumValueObject;

final class BikeType extends EnumValueObject
{
    public const Gravel  = 'G';
    public const Road    = 'R';
    public const Touring = 'T';

    private const TYPES = [self::Gravel, self::Road, self::Touring];

    protected function possibleValues(): array
    {
        return self::TYPES;
    }
}
