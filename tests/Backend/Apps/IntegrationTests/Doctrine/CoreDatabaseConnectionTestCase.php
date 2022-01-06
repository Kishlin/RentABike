<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Apps\IntegrationTests\Doctrine;

use Kishlin\Tests\Backend\Symfony\DependencyProvider\DatabaseConnectionProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Throwable;

abstract class CoreDatabaseConnectionTestCase extends WebTestCase
{
    protected function doTestDatabaseConnection(): void
    {
        $kernel = self::bootKernel();

        try {
            $connection = DatabaseConnectionProvider::get($kernel->getContainer());
        } catch (Throwable $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue($connection->isConnected());
    }
}
