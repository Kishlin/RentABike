<?php /** @noinspection PhpPureAttributeCanBeAddedInspection */

namespace App\Tests\FunctionalTests\Monitoring\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

final class ServiceStatusIsShowingConstraint extends Constraint
{
    public function __construct(
        private string $service
    )
    { }

    public function toString(): string
    {
        return "is showing the status of `$this->service`";
    }

    /**
     * {@inheritdoc}
     *
     * @var array $data
     *
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    protected function matches($data): bool
    {
        return array_key_exists($this->service, $data);
    }

    /**
     * {@inheritdoc}
     *
     * @param array $data
     *
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    protected function failureDescription($data): string
    {
        return parent::failureDescription($data);
    }

    /**
     * {@inheritdoc}
     *
     * @param array $data
     *
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    protected function additionalFailureDescription($data): string
    {
        $serviceList = join(', ', array_keys($data));
        return "Listed services: $serviceList.";
    }
}
