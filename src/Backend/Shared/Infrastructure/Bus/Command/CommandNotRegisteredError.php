<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Bus\Command;

use Kishlin\Backend\Shared\Domain\Bus\Command\Command;
use RuntimeException;

final class CommandNotRegisteredError extends RuntimeException
{
    public function __construct(Command $command)
    {
        $commandClass = get_class($command);

        parent::__construct("The command <$commandClass> has no command handler associated");
    }
}
