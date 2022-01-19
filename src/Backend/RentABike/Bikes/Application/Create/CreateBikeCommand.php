<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Bikes\Application\Create;

use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeName;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeType;
use Kishlin\Backend\Shared\Domain\Bus\Command\Command;
use Kishlin\Backend\Shared\Domain\Bus\Message\Mapping;

final class CreateBikeCommand implements Command
{
    use Mapping;

    private function __construct(
        private string $id,
        private string $type,
        private string $name,
    ) {}

    public function id(): BikeId
    {
        return new BikeId($this->id);
    }

    public function type(): BikeType
    {
        return new  BikeType($this->type);
    }

    public function name(): BikeName
    {
        return new BikeName($this->name);
    }

    public static function fromRequestData(array $request): self
    {
        return new self(
            self::getString($request, 'id'),
            self::getString($request, 'type'),
            self::getString($request, 'name'),
        );
    }

    public static function fromScalars(string $id, string $type, string $name): self
    {
        return new self($id, $type, $name);
    }
}
