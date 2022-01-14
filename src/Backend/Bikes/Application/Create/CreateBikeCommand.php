<?php

declare(strict_types=1);

namespace Kishlin\Backend\Bikes\Application\Create;

use Kishlin\Backend\Shared\Domain\Bus\Command\Command;

final class CreateBikeCommand implements Command
{
    public function __construct(
        private string $id,
        private string $type,
        private string $name,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function name(): string
    {
        return $this->name;
    }
}
