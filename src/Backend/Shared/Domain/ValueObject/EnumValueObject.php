<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Domain\ValueObject;

abstract class EnumValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValid($value);

        parent::__construct($value);
    }

    abstract protected function possibleValues(): array;

    private function ensureIsValid(string $value): void
    {
        if (false === $this->isValid($value)) {
            throw new \InvalidArgumentException(
                sprintf('%s does not allow value %s.', static::class, $value)
            );
        }
    }

    private function isValid(string $value): bool
    {
        return in_array($value, static::possibleValues());
    }
}
