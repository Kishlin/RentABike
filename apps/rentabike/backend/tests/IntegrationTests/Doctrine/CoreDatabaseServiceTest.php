<?php

declare(strict_types=1);

namespace Kishlin\Tests\Apps\Rentabike\Backend\IntegrationTests\Doctrine;

use Doctrine\DBAL\Exception;
use Kishlin\Tests\Backend\Apps\AbstractIntegrationTests\Doctrine\CoreDatabaseServiceTestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

final class CoreDatabaseServiceTest extends CoreDatabaseServiceTestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function testItHasAnActiveDatabaseConnection(): void
    {
        self::assertItHasAnActiveDatabaseConnection($this->getContainer());
    }
}
