<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Doctrine;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use ReflectionException;

final class DoctrineEntityManagerFactory
{
    /**
     * @throws ORMException|Exception|ReflectionException
     */
    public static function create(
        array $parameters,
        array $contextPrefixes,
        array $dbalCustomTypesClasses,
        bool $isDevMode
    ): EntityManagerInterface {
        DbalCustomTypesRegistrar::register($dbalCustomTypesClasses);

        return EntityManager::create($parameters, self::createDoctrineConfiguration($contextPrefixes, $isDevMode));
    }

    private static function createDoctrineConfiguration(array $contextPrefixes, bool $isDevMode): Configuration
    {
        $config = Setup::createConfiguration($isDevMode, null, null);

        $config->setMetadataDriverImpl(new SimplifiedXmlDriver($contextPrefixes));

        return $config;
    }
}
