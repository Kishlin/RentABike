<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\PHPUnit\Monitoring\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

final class ProbeIsAliveConstraint extends Constraint
{
    public function __construct(
        private string $service
    )
    { }

    public function toString(): string
    {
        return "service $this->service is alive.";
    }

    /**
     * {@inheritdoc}
     *
     * @var bool $status
     *
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    protected function matches($status): bool
    {
        return true === $status;
    }
}
