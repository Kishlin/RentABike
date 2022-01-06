<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Symfony\DependencyProvider;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Throwable;

final class DatabaseConnectionProvider
{
    /**
     * @throws Throwable
     */
    public static function get(ContainerInterface $container): Connection
    {
        /** @var ?Registry $registry */
        $registry = $container->get('doctrine');

        if (null === $registry) {
            throw new ServiceNotFoundException('doctrine');
        }

        /** @var Connection $connection */
        $connection = $registry->getConnection();
        $connection->connect();

        return $connection;
    }
}
