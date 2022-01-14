<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Infrastructure\Persistence\Doctrine;

use Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class BikeIdType extends UuidType
{
    protected function typeName(): string
    {
        return 'bike_id';
    }
}
