<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Apps\AbstractIntegrationTests\Doctrine;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class CoreDatabaseServiceTestCase extends WebTestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    protected static function assertItHasAnActiveDatabaseConnection(
        ContainerInterface $container,
        string $serviceId = EntityManagerInterface::class
    ): void {
        /** @var ?EntityManagerInterface $entityManager */
        $entityManager = $container->get($serviceId);

        if (null === $entityManager) {
            self::fail('Failed to get the database service from the container.');
        }

        $connection = $entityManager->getConnection();
        $connection->connect();

        self::assertTrue($connection->isConnected());
    }
}
