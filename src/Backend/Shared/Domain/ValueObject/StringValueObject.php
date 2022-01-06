<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(
        protected string $value
    ) {}

    public function value(): string
    {
        return $this->value;
    }
}