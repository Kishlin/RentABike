<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Tools\Test;

use Doctrine\ORM\EntityManagerInterface;
use Kishlin\Backend\RentABike\Shared\Infrastructure\Doctrine\RentABikeEntityManagerFactory;
use PHPUnit\Framework\TestCase;

abstract class RepositoryContractTestCase extends TestCase
{
    private static ?EntityManagerInterface $entityManager = null;

    protected static function entityManager(): EntityManagerInterface
    {
        if (null === static::$entityManager) {
            static::$entityManager = RentABikeEntityManagerFactory::create(
                ['url' => $_ENV['DATABASE_URL']],
                'test'
            );
        }

        return static::$entityManager;
    }

    protected function setUp(): void
    {
        static::entityManager()->beginTransaction();
    }

    protected function tearDown(): void
    {
        if (null !== static::$entityManager) {
            static::$entityManager->rollback();
            static::$entityManager->close();

            static::$entityManager = null;
        }
    }
}
