<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Domain;

interface BikeGateway
{
    public function save(Bike $bike): void;
}
