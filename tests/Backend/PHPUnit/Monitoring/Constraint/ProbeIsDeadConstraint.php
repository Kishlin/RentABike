<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\PHPUnit\Monitoring\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

final class ProbeIsDeadConstraint extends Constraint
{
    public function __construct(
        private string $service
    )
    { }

    public function toString(): string
    {
        return "service $this->service is dead.";
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
        return false === $status;
    }
}
