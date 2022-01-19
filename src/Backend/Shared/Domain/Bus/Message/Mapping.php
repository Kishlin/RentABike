<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain\Bus\Message;

trait Mapping
{
    private static function getString(array $source, string $key): string
    {
        return isset($source[$key]) ? (string)$source[$key] : '';
    }
}
