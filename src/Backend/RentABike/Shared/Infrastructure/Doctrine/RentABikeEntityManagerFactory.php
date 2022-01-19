<?php

declare(strict_types=1);

namespace Kishlin\Backend\RentABike\Shared\Infrastructure\Doctrine;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Kishlin\Backend\Shared\Infrastructure\Doctrine\DoctrineCustomTypeSearcher;
use Kishlin\Backend\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Kishlin\Backend\Shared\Infrastructure\Doctrine\DoctrinePrefixesSearcher;
use ReflectionException;

final class RentABikeEntityManagerFactory
{
    /**
     * @throws ReflectionException|Exception|ORMException
     */
    public static function create(array $parameters, string $environment): EntityManagerInterface
    {
        $isDevMod = 'prod' !== $environment;

        $prefixes = array_merge(
            DoctrinePrefixesSearcher::inPath(
                path:__DIR__ . '/../../../../RentABike',
                mappingsPath: 'Infrastructure/Persistence/Doctrine/Mapping',
                baseNamespace: 'Kishlin\Backend\RentABike',
            ),
            DoctrinePrefixesSearcher::inPath(
                path: __DIR__ . '/../../../../Shared',
                mappingsPath: 'Infrastructure/Persistence/Doctrine/Mapping',
                baseNamespace: 'Kishlin\Backend\Shared',
            ),
        );

        $dbalCustomTypes = DoctrineCustomTypeSearcher::inPath(
            path: __DIR__ . '/../../../../RentABike',
            typesPath: 'Infrastructure/Persistence/Doctrine',
            baseNamespace: 'Kishlin\Backend\RentABike',
        );

        return DoctrineEntityManagerFactory::create(
            $parameters,
            $prefixes,
            $dbalCustomTypes,
            $isDevMod,
        );
    }
}
